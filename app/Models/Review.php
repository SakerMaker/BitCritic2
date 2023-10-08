<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    static $rules = [
		'id_game' => 'required',
		'id_user' => 'required',
        'title' => 'required|max:255',
        'content' => 'required',
    ];
    
    protected $fillable = [
        'id_game','id_user', 'title', 'content', 'rate',
    ];

}
