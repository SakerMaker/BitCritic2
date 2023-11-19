<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Followbc extends Component
{

    public $follower;
    public $followed;
    public $follows;
    public $followToggle;
    public $sizeCss;

    public function mount($follower, $followed, $follows = false, $sizeCss = false) {
        $this->follower=User::find($follower);
        $this->followed=User::find($followed);
        $this->follows=$follows;
        $this->sizeCss=$sizeCss;
    }

    public function followToggle() {
        if ($this->follows) {
            $this->follower->unfollow($this->followed);
            $this->follows = false;
        } else {
            $this->follower->follow($this->followed);
            $this->follows = true;
        }
        $this->emitTo('followers-count', 'refreshComponent');
    }

    public function render()
    {
        
        if ($this->follower->isFollowing($this->followed)) {
            $this->follows = true;
        } else {
            $this->follows = false;
        }


        return view('livewire.followbc');
    }
    public static function deleted() {

    }
}
