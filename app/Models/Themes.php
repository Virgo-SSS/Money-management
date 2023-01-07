<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;

    protected $table = 'themes';

    protected $fillable = [
        'user_id',
        'mode',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
