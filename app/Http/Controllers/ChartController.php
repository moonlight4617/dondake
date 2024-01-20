<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ChartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $today = Carbon::now();

        $thisYear = $today->year;
        $thisMonth = $today->month;

        $targetStartDate = Carbon::parse($thisYear . "-" . $thisMonth);
        $targetEndDate = $targetStartDate->copy()->endOfMonth();

        $sales_data = Temperature::select(
            'sale_date',
            'temperature',
            'weather',
            'item_id',
            DB::raw('SUM(sales.sale_price * sales.quantity) as sales'),
            DB::raw('SUM(sales.sale_cost * sales.quantity) as costs')
        )
            ->whereBetween("sale_date", [$targetStartDate, $targetEndDate])
            ->leftJoin('sales', 'temperatures.id', '=', 'sales.temperature_id')
            ->groupBy('temperatures.sale_date', 'sales.item_id', 'temperatures.temperature', 'temperatures.weather')
            ->get()
            ->toArray();

        return Inertia::render(
            'Dashboard',
            ['sales_data' => $sales_data,]
        );
    }
}
