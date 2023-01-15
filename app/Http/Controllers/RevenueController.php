<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Http\Requests\StoreRevenueRequest;
use App\Http\Requests\UpdateRevenueRequest;
use Carbon\Carbon;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenues = Revenue::where('user_id', auth()->id())->orderBy('date', 'desc')->get();

        $revenues->map(function ($item) {
            $item->amount = number_format($item->amount , 0, ',', '.');
            $item->date = Carbon::parse($item->date)->format('d F Y');
        }); 
        return view('revenue.index', compact('revenues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('revenue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRevenueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRevenueRequest $request)
    {
        Revenue::create([
            'user_id'     => auth()->id(),
            'description' => $request->description,
            'note'        => $request->note ?? null,
            'amount'      => $request->amount,
            'date'        => $request->date,
        ]);

        return redirect()->route('revenue')->with('success', 'Revenue created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function edit(Revenue $revenue)
    {
        return response()->json($revenue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRevenueRequest  $request
     * @param  \App\Models\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRevenueRequest $request, Revenue $revenue)
    {
        $revenue->update([
            'description' => $request->description,
            'note'        => $request->note ?? null,
            'amount'      => $request->amount,
            'date'        => $request->date,
        ]);

        return redirect()->route('revenue')->with('success', 'Revenue updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revenue $revenue)
    {
        $revenue->delete();

        return redirect()->route('revenue')->with('success', 'Revenue deleted successfully');
    }
}
