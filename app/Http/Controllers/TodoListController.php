<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoriesRequest;
use App\Http\Requests\DeleteCategoriesRequest;
use App\Http\Requests\StoreTodolistRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\TodoList;
use App\Models\TodoListCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoListController extends Controller
{
    /**
     * Show the todolist page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todolists = TodoList::where('user_id', Auth::id())->get();
        return view('todolist.index', compact('todolists'));
    }

    /**
     * Show the create todolist page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $todolist_category = TodoListCategories::where('user_id', Auth::id())->get();
        if($request->ajax()){
            return response()->json($todolist_category);
        }
        return view('todolist.create', compact('todolist_category'));
    }

    public function store(StoreTodolistRequest $request)
    {
        TodoList::create([
            'user_id' => Auth::id(),
            'task' => $request->task,
            'category_id' => $request->category,
            'deadline' => $request->date ?? null,
        ]);

        return redirect()->route('todolist')->with('success', 'Task added successfully');
    }

    public function addCategory(AddCategoriesRequest $request)
    {
        TodoListCategories::create([
            'user_id' => Auth::id(),
            'name' => $request->category_name,
        ]);

        return redirect()->route('todolist.create');
    }

    public function updateCategory(UpdateCategoriesRequest $request)
    {
        TodoListCategories::where('id', $request->id)->where('user_id', Auth::id())
            ->update([
            'name' => $request->name,
        ]);

        return redirect()->route('todolist.create');
    }

    public function deleteCategory(DeleteCategoriesRequest $request)
    {
        TodoListCategories::where('id', $request->id)->where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'success']);
    }
}
