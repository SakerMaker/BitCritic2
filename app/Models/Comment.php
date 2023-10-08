<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    static $rules = [
		'id_review' => 'required',
		'id_user' => 'required',
        'content' => 'required|max:65535',
    ];

    protected $fillable = [
        'id_review','id_user','content',
    ];

}
