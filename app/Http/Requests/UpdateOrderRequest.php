<?php
/**
 * Created by PhpStorm
 * Filename: UpdateOrderRequest.php
 * User: Nguyễn Văn Ước
 * Date: 19/3/25
 * Time: 00:02
 */

namespace App\Http\Requests;

use App\Enum\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        $order = $this->route('order');
        return [
            'status'        => [
                Rule::requiredIf($order->type == \App\Enum\PaymentType::COD),
                Rule::enum(PaymentStatus::class),
            ],
            'shipping_unit' => [
                Rule::requiredIf($order->status == \App\Enum\PaymentStatus::SHIPPING),
                'nullable',
                'string',
            ],
            'shipping_code' => [
                Rule::requiredIf($order->status == \App\Enum\PaymentStatus::SHIPPING),
                'nullable',
                'string',
            ],
            'note'          => 'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return Auth::guard('web')->check();
    }
}
