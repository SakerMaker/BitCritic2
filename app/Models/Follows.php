<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    use HasFactory;

    static $rules = [
		'id_user_followed' => 'required',
		'id_user_following' => 'required',
    ];

    protected $fillable = [
        'id_user_followed','id_user_following',
    ];

}
