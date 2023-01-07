<?php

namespace App\Http\Controllers;

use App\Models\Themes;
use Illuminate\Http\Request;
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

        return view('home');
    }
}
