<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm (phân trang)
    public function index(Request $request)
    {
        $search = $request->get('q');
        $c      = $request->get('c');

        $query = Product::query()->with('category')
            ->where('stock', '>', 0)
            ->orderBy('id', 'desc');
        if ($search) {
            $search = \Str::lower($search);
            $query  = $query
                ->whereRaw("LOWER(name) REGEXP '{$search}'");
        }

        if ($c > 0) {
            $query = $query->where('category_id', (int) $c);
        }
        $products = $query->paginate(10);

        return view('products.index', compact('products', 'search', 'c'));
    }

    // Hiển thị danh sách sản phẩm cho trang chủ
    public function home()
    {
        $products_35_38 = Product::whereBetween('id', [35, 38])->get();
        $products_39_42 = Product::whereBetween('id', [39, 42])->get();
        $products_43_46 = Product::whereBetween('id', [43, 46])->get();
        $products_47_53 = Product::whereBetween('id', [47, 53])->get();

        return view('home', compact('products_35_38', 'products_39_42', 'products_43_46', 'products_47_53'));
    }

    // Hiển thị danh sách sản phẩm cho trang sản phẩm
    public function product()
    {
        $products_39_42 = Product::whereBetween('id', [39, 42])->get();
        $products_43_46 = Product::whereBetween('id', [43, 46])->get();
        $products_48_50 = Product::whereBetween('id', [48, 50])->get();
        $products_51_53 = Product::whereBetween('id', [51, 53])->get();
        $product_47     = Product::find(47);
        return view('product', compact('products_39_42', 'products_43_46', 'product_47', 'products_48_50', 'products_51_53'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục từ cơ sở dữ liệu
        return view('products.create', compact('categories'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name'         => ['required', 'string', 'max:255', 'regex:/^[^\d]*$/'], // Không chứa số trong tên
            'description'  => 'required|string|max:1000',
            'price'        => 'required|numeric|min:0', // Giá phải là số dương
            'stock'        => 'required|integer|min:0', // Số lượng phải là số nguyên dương
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tệp hình ảnh hợp lệ
            'size'         => 'nullable|string|max:50',
            'color'        => 'nullable|string|max:50',
            'product_code' => 'nullable|string|max:100|unique:products,product_code', // Mã không trùng
        ], [
            'product_code.unique' => 'Mã sản phẩm đã tồn tại.',
            'name.regex'          => 'Tên sản phẩm không được chứa số.',
        ]);

        // Lưu hình ảnh nếu có
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('images', 'public')
            : null;

        // Tạo mã sản phẩm tự động nếu không nhập
        $productCode = $request->filled('product_code')
            ? $request->product_code
            : strtoupper(substr($request->name, 0, 3)).time(); // Ví dụ: "PRO123456789"

        // Tạo sản phẩm mới
        Product::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price, // Lưu giá ở dạng số
            'stock'        => $request->stock,
            'category_id'  => $request->category_id,
            'image'        => $imagePath,
            'size'         => $request->size,
            'color'        => $request->color,
            'product_code' => $productCode, // Lưu mã sản phẩm
        ]);
        // dd($request->all());
        // Điều hướng về danh sách sản phẩm với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }


    // Hiển thị chi tiết sản phẩm
    public function showProductDetails($id)
    {
        $product = Product::with('transactions')->findOrFail($id);
        $sizes   = $product->size ? explode(',', $product->size) : [];
        $colors  = $product->color ? explode(',', $product->color) : [];
        return view('productItem', compact('product', 'sizes', 'colors'));
    }

    // Hiển thị form sửa sản phẩm
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all(); // Lấy danh mục

        return view('products.edit', compact('product', 'categories'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'         => ['required', 'string', 'max:255', 'regex:/^[^\d]*$/'],
            'description'  => 'required',
            'price'        => 'required|numeric',
            'stock'        => 'required|integer',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size'         => 'nullable|string|max:50',
            'color'        => 'nullable|string|max:50',
            'product_code' => 'required|string|max:100|unique:products,product_code,'.$product->id, // Chấp nhận trùng với chính nó
        ], [
            'product_code.unique' => 'Mã sản phẩm đã tồn tại.',
            'name.regex'          => 'Tên sản phẩm không được chứa số.',
        ]);

        // Lưu hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath      = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        // Cập nhật thông tin sản phẩm
        $product->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price, // Cập nhật giá sản phẩm
            'stock'        => $request->stock,
            'category_id'  => $request->category_id,
            'size'         => $request->size,
            'color'        => $request->color,
            'product_code' => $request->product_code, // Cập nhật mã sản phẩm
        ]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::query()->findOrFail($id);
        $product->update(['stock' => 0]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa.');
    }

    public function search(Request $request)
    {
        $query    = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->take(10)->get();
        return response()->json($products);
    }

    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Giả sử kích thước và màu sắc được lưu dạng JSON hoặc chuỗi trong DB
        $sizes  = $product->size ? json_decode($product->size, true) : [];
        $colors = $product->color ? json_decode($product->color, true) : [];

        return view('productItem', compact('product', 'sizes', 'colors'));
    }


    public function addToCart(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'required|string',
            'color'      => 'required|string',
            'quantity'   => 'required|integer|min:1',
        ]);

        // Lấy thông tin sản phẩm
        $product = Product::findOrFail($validated['product_id']);

        // Thêm sản phẩm vào giỏ hàng
        Cart::add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => $validated['quantity'],
            'price'   => $product->price,
            'options' => [
                'size'  => $validated['size'],
                'color' => $validated['color'],
            ],
        ]);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }


}
