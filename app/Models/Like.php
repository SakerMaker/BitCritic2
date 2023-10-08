<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    static $rules = [
		'id_user' => 'required',
		'id_review' => 'required',
    ];

    protected $fillable = [
        'id_user','id_review',
    ];
}
