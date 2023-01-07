<?php

namespace App\Http\Requests;

use App\Rules\TodoListCategoryExist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTodolistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'task' => 'required|string|max:255',
            'category' => 'required|integer|', new TodoListCategoryExist(),
            'date' => 'nullable|date',
        ];
    }
}
