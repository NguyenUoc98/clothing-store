<?php
namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('promotion.index', compact('promotions'));
    }

    public function create()
    {
        return view('promotion.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:promotions,name', // Kiểm tra tên không trùng
        'type' => 'required',
        'discount_amount' => 'nullable|numeric',
        'discount_percent' => 'nullable|numeric|min:0|max:100',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ], [
        'name.unique' => 'Tên khuyến mãi đã tồn tại, vui lòng chọn tên khác.',
    ]);

    // Tiến hành lưu khuyến mãi
    Promotion::create($request->all());

    return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được tạo thành công.');
}

    public function edit(Promotion $promotion)
    {
        return view('promotion.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'name' => 'required',
            'discount_amount' => 'nullable|numeric',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $promotion->update($request->all());

        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được cập nhật.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được xóa.');
    }
}
