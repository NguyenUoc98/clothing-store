<?php

namespace App\Http\Controllers;

use App\Enum\PaymentStatus;
use App\Enum\PaymentType;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('cart.items.product')->paginate(10);
        return view('orders.index', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::with('cart.items.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $information = [
            'note' => [
                'name'  => 'Ghi chú',
                'value' => $request->note,
            ],
        ];

        $dataUpdate = [];

        if ($order->type == PaymentType::COD) {
            $information['shipping_unit'] = [
                'name'  => 'Đơn vị chuyển',
                'value' => $request->shipping_unit,
            ];
            $information['shipping_code'] = [
                'name'  => 'Mã vận đơn',
                'value' => $request->shipping_code,
            ];
            $dataUpdate                   = $request->only('status');
        }
        $dataUpdate['addition_information'] = $information;

        $order->update($dataUpdate);

        // Gửi email xác nhận nếu trạng thái là 'shipping'
        if ($order->type == PaymentType::COD && $request->status == PaymentStatus::SHIPPING) {
            Mail::to($order->customer_email)->send(new \App\Mail\OrderShipped($order));
        }

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }


    public function printInvoice($id)
    {
        $order = Order::with('cart.items.product')->findOrFail($id);
        $pdf   = \Pdf::loadView('orders.invoice', compact('order'));
        return $pdf->download('invoice-'.$order->id.'.pdf');
    }

}
