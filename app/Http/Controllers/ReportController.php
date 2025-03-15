<?php

// app/Http/Controllers/ReportController.php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function revenueReport()
    {
        $revenue = Transaction::with('products') // Lấy cả thông tin sản phẩm
                              ->selectRaw('DATE(transaction_date) as date, SUM(total_amount) as total_revenue')
                              ->groupBy('date')
                              ->get();

        return view('reports.revenue', compact('revenue'));
    }

    public function productReport()
    {
        $items = Product::withCount('transactions') // Lấy số lần giao dịch của từng sản phẩm
                        ->orderBy('transactions_count', 'desc')
                        ->get();

        return view('reports.products', compact('items'));
    }
}
