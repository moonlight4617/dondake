<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $targetStartDate = Carbon::parse($request->targetYear . "-" . $request->targetMonth);
        $targetEndDate = $targetStartDate->copy()->endOfMonth();
        // Log::debug($targetStartDate);
        // Log::debug($targetEndDate);

        // $temperature = Temperature::whereBetween("sale_date", [$targetStartDate, $targetEndDate])->get();
        $sale_data = Temperature::select(
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
            ->get();
        // Log::debug($temperature);

        return response()->json([
            'data' => $sale_data
        ], Response::HTTP_OK);
    }
}
