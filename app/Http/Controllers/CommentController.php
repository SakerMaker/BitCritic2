<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::paginate();

        return view('comment.index', compact('comments'))
            ->with('i', (request()->input('page', 1) - 1) * $comments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allUsers=User::all();
        $allReviews=Review::all();
        $comment = new Comment();
        return view('comment.create', compact('comment','allUsers','allReviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(Comment::$rules);

        $comment = Comment::create($request->all());

        return redirect()->back()
            ->with('success', 'Comment created successfully.');
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
        $comment = Comment::find($id);
        $allUsers = User::all();
        $allReviews = Review::all();
        return view('comment.edit', compact('comment','allUsers','allReviews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        request()->validate(Comment::$rules);

        $comment->update($request->all());

        return redirect()->back('comments.index')
            ->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id)->delete();

        return redirect()->back()
            ->with('success', 'Comment deleted successfully');
    }
}
