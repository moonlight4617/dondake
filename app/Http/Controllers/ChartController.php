<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
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
        // 日別でその日の売上合計、粗利益合計を計算
        $sales_data = Temperature::select(
            'sale_date',
            'temperature',
            'weather',
            'item_id',
            DB::raw('SUM(sales.sale_price * sales.quantity) as sales'),
            DB::raw('SUM(sales.sale_cost * sales.quantity) as costs')
        )
            ->leftJoin('sales', 'temperatures.id', '=', 'sales.temperature_id')
            ->groupBy('temperatures.sale_date', 'sales.item_id', 'temperatures.temperature', 'temperatures.weather')
            ->get()
            ->toArray();

        // $collection = collect($sales_data);

        // $groupBySaleDate = $collection->groupBy('sale_date');
        // $groupByTemperature = $collection->groupBy('temperature');
        // $groupByWeather = $collection->groupBy('weather');
        // $groupBySales = $collection->groupBy('sales');
        // $groupByCosts = $collection->groupBy('costs');

        // dd($groupBySaleDate, $groupByTemperature, $groupByWeather, $groupBySales, $groupByCosts);

        // $date_list = array_column($sales_data, 'sale_date')->groupBy;


        // dd($date_list);
        // dd($date_list);


        return Inertia::render(
            'Dashboard',
            ['sales_data' => $sales_data,]
        );
    }
}
