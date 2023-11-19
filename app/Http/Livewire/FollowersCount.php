<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowersCount extends Component
{
    public $user;
    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public function render()
    {
        $followerCount = User::find($this->user)->followers->count();
        return view('livewire.followers-count')->with("followerCount",$followerCount);
    }
}
