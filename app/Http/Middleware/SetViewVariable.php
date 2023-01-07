<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SetViewVariable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->setCountTodolist();

        return $next($request);
    }

    private function setCountTodolist()
    {
        if(Auth::check()){
            $count_todolist = TodoList::where('user_id', Auth::id())->where('completed', false)->count();
            View::share('count_todolist', $count_todolist);
        }
    }
}
