<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Review extends Model
{
    use HasFactory;
    use Likeable;

    static $rules = [
		'id_game' => 'required',
		'id_user' => 'required',
        'title' => 'required|max:255|alpha',
        'content' => 'required|alpha',
    ];
    
    protected $fillable = [
        'id_game','id_user', 'title', 'content', 'rate',
    ];

}
