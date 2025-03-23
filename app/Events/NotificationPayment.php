<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationPayment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Order $order) {}

    public $queue = 'notification';

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        $message = 'Thanh toán thành công đơn hàng '.md5($this->order->id).'. Số tiền '. number_format($this->order->total_price, 0, ',', '.').'đ';
        return [
            'message' => $message
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        if ($this->order->cart->user_id) {
            $channel = [
                new PrivateChannel("App.Models.Customer.{$this->order->cart->user_id}"),
            ];
        } else {
            $channel = [
                new Channel("guest_id.{$this->order->cart->guest_id}"),
            ];
        }
        return $channel;
    }
}
