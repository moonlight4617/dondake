<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Temperature;
use Illuminate\Database\QueryException;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            'Sales/Index',
            ['sales_data' => $sales_data,]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::select('id', 'name', 'price', 'cost')->get();

        return Inertia::render('Sales/Create', [
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
        try {
            DB::transaction(
                function () use ($request) {
                    Temperature::updateOrInsert(
                        ['sale_date' => $request->date],
                        [
                            'temperature' => $request->temperature,
                            'weather' => $request->weather,
                        ]
                    );

                    $temperature = Temperature::where('sale_date', $request->date)->first();

                    foreach ($request->items as $item) {
                        Sale::create([
                            'user_id' => $request->user()->id,
                            'item_id' => $item["id"],
                            'temperature_id' => $temperature->id,
                            'sale_price' => $item["price"],
                            'quantity' => $item["quantity"],
                            'sale_cost' => $item["cost"],
                        ]);
                    }
                }
            );
        } catch (QueryException $e) {
            return to_route('sales.create')->with([
                'message' => '登録に失敗しました',
                'status' => 'error'
            ]);
        }

        return to_route('dashboard')->with([
            'message' => '登録しました',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
