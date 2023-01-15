<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Themes;
use App\Models\Expense;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_themes = Auth::user()->themes;
        if(!$user_themes) {
            Themes::create([
                'user_id' => auth()->user()->id,
                'mode' => 'light',
            ]);
        }

        $revenueMonth = Revenue::select(DB::raw("sum(amount) as amount"), DB::raw("MONTHNAME(date) as month_name"))
        ->where('user_id', auth()->user()->id)
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('amount', 'month_name');

        $labelRevenue =  $revenueMonth->keys();
        $dataRevenue =  $revenueMonth->values();

        $expenseMonth = Expense::select(DB::raw("sum(amount) as amount"), DB::raw("MONTHNAME(date) as month_name"))
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('amount', 'month_name');

        $labelExpense = $expenseMonth->keys();
        $dataExpense = $expenseMonth->values();


        return view('home', compact('labelRevenue', 'dataRevenue', 'labelExpense', 'dataExpense'));
    }
}
