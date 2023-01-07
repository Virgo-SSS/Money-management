<?php

namespace App\Models;

use App\Scopes\TodolistScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $table = 'todolist';

    protected $fillable = [
        'user_id',
        'task',
        'category_id',
        'completed',
        'completed_at',
        'deadline',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
    */
    protected static function booted()
    {
        static::addGlobalScope(new TodolistScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TodoListCategories::class);
    }
}
