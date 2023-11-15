<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Enums\Image\Size;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Genre;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('index')->with("page",$request->page);
    }
}
