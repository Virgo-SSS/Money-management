<?php

namespace App\Http\Controllers;

use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Show the settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Update user Appearance settings.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appearance(Request $request)
    {
        $request->validate([
            'mode' => 'required',
        ]);

        Themes::where('user_id', Auth::id())->update([
            'mode' => $request->mode,
        ]);

        return redirect()->route('settings');

    }
}
