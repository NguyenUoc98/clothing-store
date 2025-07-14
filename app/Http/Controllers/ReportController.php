<?php

// app/Http/Controllers/ReportController.php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Enum\PaymentStatus;
use App\Models\CartItem;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function revenueReport(Request $request)
    {
        $startDate  = $request->get('start_date') ?: Carbon::now()->startOfMonth()->toDateString();
        $endDate    = $request->get('end_date') ?: Carbon::now()->toDateString();

        $statistics = Order::query()
            ->selectRaw('SUM(total_price) as money, DATE(updated_at) as date')
            ->where('status', PaymentStatus::SUCCESS)
            ->where('updated_at', '>=', Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay())
            ->where('updated_at', '<=', Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay())
            ->groupByRaw('DATE(updated_at)')
            ->orderByDesc('date')
            ->paginate(5);

        return view('reports.revenue', compact('statistics'));
    }

    public function productReport()
    {
        $statistics = CartItem::query()
            ->selectRaw('product_id, SUM(quantity) as count, SUM(price) as money')
            ->leftJoin('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->leftJoin('orders', 'carts.id', '=', 'orders.cart_id')
            ->where('orders.status', PaymentStatus::SUCCESS)
            ->with(['product', 'product.category'])
            ->groupBy('product_id')
            ->orderByDesc('money')
            ->orderByDesc('count')
            ->paginate(5);

        return view('reports.products', compact('statistics'));
    }
}
