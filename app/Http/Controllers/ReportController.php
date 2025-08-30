<?php

// app/Http/Controllers/ReportController.php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Enum\PaymentStatus;
use App\Models\CartItem;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function revenueReport(Request $request)
    {
        $start     = $request->get('start_date');
        $end       = $request->get('end_date');
        $dateGroup = $request->get('date_group', 'date');

        if (!$start || !$end) {
            $start = now()->firstOfMonth()->toDateString();
            $end   = now()->toDateString();
        }

        $startDate = Carbon::createFromFormat('Y-m-d', $start)->startOfDay();
        $endDate   = Carbon::createFromFormat('Y-m-d', $end)->endOfDay();

        if ($dateGroup == 'month') {
            $startDate = $startDate->startOfMonth();
            $endDate   = $endDate->endOfMonth();
        } elseif ($dateGroup == 'year') {
            $startDate = $startDate->startOfYear();
            $endDate   = $endDate->endOfYear();
        } elseif ($dateGroup == 'week') {
            $startDate = $startDate->startOfWeek(CarbonInterface::MONDAY);
            $endDate   = $endDate->endOfWeek(CarbonInterface::SUNDAY);
        }

        $index  = $endDate;
        $result = [];
        while ($index > $startDate) {
            $firstTime = match ($dateGroup) {
                'month' => (clone $index)->startOfMonth()->subSecond(),
                'date'  => (clone $index)->subDay(),
                'week'  => (clone $index)->startOfWeek(CarbonInterface::MONDAY),
                'year'  => (clone $index)->startOfYear(),
                default => $startDate,
            };

            $stringDate = match ($dateGroup) {
                'month' => Str::ucfirst((clone $firstTime)->addDay()->locale('vi')->translatedFormat('F, Y')),
                'date'  => Str::ucfirst((clone $index)->locale('vi')->translatedFormat('l, d-m-Y')),
                'year'  => Str::ucfirst((clone $index)->locale('vi')->translatedFormat('\N\ă\m Y')),
                default => Str::ucfirst((clone $firstTime)->locale('vi')->translatedFormat('l, d/m/Y')).' đến '.
                    Str::ucfirst((clone $index)->locale('vi')->translatedFormat('l, d/m/Y')),
            };

            $statistics = Order::query()
                ->where('status', PaymentStatus::SUCCESS)
                ->where('updated_at', '>=', $firstTime)
                ->where('updated_at', '<=', $index)
                ->sum('total_price');

            $result[$stringDate] = $statistics;

            if ($dateGroup == 'week') {
                $index->subWeek()->setTime(23, 59, 59);
            } else {
                $index = $firstTime;
            }
        }

        return view('reports.revenue', compact('result'));
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
