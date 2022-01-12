<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OrderChart;
use App\Contracts\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(OrderRepository $orderRepository)
    {

        $order = $orderRepository
            ->whereYear('created_at', Carbon::now()->year)
            ->whereStatus(config('const.approve'))
            ->get()
            ->groupBy(
                function ($date) {
                    return (int) $date->created_at->format('m');
                }
            )->map(
                function ($item) {
                    return array_sum($item->pluck('amount')->toArray());
                }
            )->toArray();

        $month = collect(
            today()->startOfMonth()->subMonths(12)->monthsUntil(today()->startOfMonth())
        )
            ->mapWithKeys(fn ($month) => [$month->month => $month->monthName])
            ->toArray();

        // initial dataset chart
        $data = [];
        for ($i = config('const.block'); $i <= config('const.twelve'); $i++) {
            array_push($data, config('const.active'));
        }
        $data = array_combine(range(config('const.block'), count($data)), $data);

        $ordersChart = new OrderChart;
        $ordersChart->labels(array_values($month));
        $ordersChart->dataset(__('common.title_chart'), 'line', array_values(array_replace($data, $order)))
            ->color(config('const.pink_color'))
            ->backgroundcolor(config('const.pink_color'));

        return view('admin.dashboard', compact('ordersChart'));
    }
}
