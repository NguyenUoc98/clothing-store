<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
    $orders = Order::with('items.product')->paginate(10);
    return view('orders.index', compact('orders'));
    }


    public function show($id)
    {
    $order = Order::with('items.product')->findOrFail($id);
    return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    // Gửi email xác nhận nếu trạng thái là 'shipped'
    if ($request->status == 'shipped') {
        Mail::to($order->customer_email)->send(new \App\Mail\OrderShipped($order));
    }

    return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }


    public function printInvoice($id)
    {
    $order = Order::with('items.product')->findOrFail($id);
    $pdf = \PDF::loadView('orders.invoice', compact('order'));
    return $pdf->download('invoice-' . $order->id . '.pdf');
    }

}
