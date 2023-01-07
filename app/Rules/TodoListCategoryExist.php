<?php

namespace App\Rules;

use App\Models\TodoListCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class TodoListCategoryExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return TodoListCategories::where('id', $value)->where('user_id', Auth::id())->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected category is invalid.';
    }
}
