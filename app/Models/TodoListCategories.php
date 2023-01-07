<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoListCategories extends Model
{
    use HasFactory;

    protected  $table = 'todolist_categories';

    protected $fillable = [
        'user_id',
        'name',
    ];

    public $timestamps = false;

    public function todolist()
    {
        return $this->hasMany(TodoList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
