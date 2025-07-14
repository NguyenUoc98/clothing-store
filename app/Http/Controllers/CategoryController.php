<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        $query  = Category::query();
        if ($search) {
            $search = \Str::lower($search);
            $query  = $query
                ->whereRaw("LOWER(name) REGEXP '{$search}'");
        }
        $categories = $query->paginate(10);
        return view('categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|regex:/^[\p{L} ]+$/u|max:255|unique:categories,name', // Kiểm tra không trùng tên danh mục
            'image'         => 'nullable|image',
            'display_order' => 'required|integer|min:1|unique:categories,display_order',
        ], [
            'name.required'          => 'Trường tên danh mục là bắt buộc.',
            'name.regex'             => 'Tên danh mục chưa hợp lí. Vui lòng nhập lại.',
            'name.unique'            => 'Tên danh mục này đã tồn tại, vui lòng chọn tên khác.',
            'display_order.required' => 'Trường số thứ tự là bắt buộc.',
            'display_order.integer'  => 'Số thứ tự phải là số nguyên.',
            'display_order.min'      => 'Số thứ tự phải là số dương.',
            'display_order.unique'   => 'Số thứ tự hiển thị này đã tồn tại, vui lòng chọn số khác.',
        ]);

        // Tạo danh mục mới
        $category                = new Category();
        $category->name          = $validated['name'];
        $category->display_order = $validated['display_order'];

        if ($request->hasFile('image')) {
            $imagePath       = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được thêm thành công!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'          => 'required|regex:/^[\p{L} ]+$/u|max:255|unique:categories,name,'.$id, // Kiểm tra không trùng tên danh mục
            'image'         => 'nullable|image',
            'display_order' => 'required|integer|min:1|unique:categories,display_order,'.$id,
        ], [
            'name.required'          => 'Trường tên danh mục là bắt buộc.',
            'name.regex'             => 'Tên danh mục chưa hợp lí. Vui lòng nhập lại.',
            'name.unique'            => 'Tên danh mục này đã tồn tại, vui lòng chọn tên khác.',
            'display_order.required' => 'Trường số thứ tự là bắt buộc.',
            'display_order.integer'  => 'Số thứ tự phải là số nguyên.',
            'display_order.min'      => 'Số thứ tự phải là số dương.',
            'display_order.unique'   => 'Số thứ tự hiển thị này đã tồn tại, vui lòng chọn số khác.',
        ]);

        // Cập nhật danh mục
        $category                = Category::findOrFail($id);
        $category->name          = $validated['name'];
        $category->display_order = $validated['display_order'];

        if ($request->hasFile('image')) {
            $imagePath       = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Danh mục không tồn tại!');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công!');
    }

    public function testEmail()
    {
        $name = 'Dao Thi Gam';
        Mail::send('emails.test', compact('name'), function ($email) use ($name) {
            $email->subject('Xac nhan mat khau');
            $email->to('gamthidao123@gmail.com', $name);
        });
    }


}
