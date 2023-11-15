<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allReviews = Review::all();

        request()->validate(Review::$rules);

        $comprobar=true;
        foreach ($allReviews as $comprobarReview){
            if($comprobarReview->id_game==$request->id_game && $comprobarReview->id_user==$request->id_user){
                $comprobar=false;
            }
        }

        if($comprobar){
            $review = Review::create($request->all());
            if(isset($_REQUEST['reviewUsuario'])){
                return redirect()->back();
            }else{
                return redirect()->back()
                ->with('success', 'Review created successfully.');
            }
        }else{
            if(isset($_REQUEST['reviewUsuario'])){
                return redirect()->back()
                ->with('error', 'Un usuario no puede crear más de una review por juego.');
            }else{
                return redirect()->back()
            ->with('error', 'Un usuario no puede crear más de una review por juego.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
