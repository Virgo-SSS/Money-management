<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->id())->orderBy('date', 'desc')->get();
        $expenses->map(function ($item) {
            $item->amount = number_format($item->amount , 0, ',', '.');
            $item->date = Carbon::parse($item->date)->format('d F Y');
        }); 
        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $request)
    {
        Expense::create([
            'user_id'     => auth()->id(),
            'description' => $request->description,
            'note'        => $request->note ?? null,
            'amount'      => $request->amount,
            'date'        => $request->date,
        ]);

        return redirect()->route('expense')->with('success', 'Expense created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseRequest  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update([
            'description' => $request->description,
            'note'        => $request->note ?? null,
            'amount'      => $request->amount,
            'date'        => $request->date,
        ]);

        return redirect()->route('expense')->with('success', 'Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expense')->with('success', 'Expense deleted successfully');
    }
}
