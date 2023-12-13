<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    //
    public function index() {
        return view("panel");
    }

    public function comments() {
        $comments = Comment::paginate();

        return view('panel.comment', compact('comments'))
            ->with('i', (request()->input('page', 1) - 1) * $comments->perPage());
    }

    public function reviews() {
        $reviews = Review::paginate(5);

        return view('panel.review', compact('reviews'))
            ->with('i', (request()->input('page', 1) - 1) * $reviews->perPage());
    }

    public function users() {
        $users = User::paginate(10);

        return view('panel.user', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    public function users_destroy($id) {
        $user = User::find($id);

        if ($user['profile_photo_path'] != "img/profileDefault.png") {
            if(file_exists($user['profile_photo_path'])){
                unlink($user['profile_photo_path']);
            }
        }
        if ($user['banner_photo_path'] != "img/bannerDefault.png") {
            if(file_exists($user['banner_photo_path'])){
                unlink($user['banner_photo_path']);
            }
        }



        $user->delete();
        return redirect()->route('panel.users')
            ->with('success', 'Usuario borrado');
    }
    public function reviews_destroy($id) {
        $review = Review::find($id)->delete();
        return redirect()->route('panel.reviews')
        ->with('success', 'Review borrada');
    }
    public function comments_destroy($id) {
        $comment = Comment::find($id)->delete();

        return redirect()->back()
            ->with('success', 'Comentario borrado');
    }
}
