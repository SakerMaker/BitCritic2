<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Like extends Component
{
    public $review;
    public $user;
    public $liked;
    public $likesCount;
    public $likers;
    public function mount($review, $liked=false) {
        $this->review = Review::find($review);
        $this->user = Auth::user();
        $this->liked = $this->user->hasLiked($this->review);
    }

    public function likeToggle() {
        if ($this->liked) {
            $this->user->unlike($this->review);
            $this->liked = false;
        } else {
            $this->user->like($this->review);
            $this->liked = true;
        }
        $this->emitTo('followers-count', 'refreshComponent');
    }
    public function render()
    {
        $this->likers=[];
        foreach($this->review->likers as $user) {
           $this->likers[]=$user;
        }
        $this->likesCount = $this->review->totalLikers;
        return view('livewire.like');
    }
}
