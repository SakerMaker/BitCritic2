<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\User;
use Livewire\Component;
use App\Traits\CountProfile;

class ShowUsers extends Component
{
    use CountProfile;
    protected $paginationTheme = 'bootstrap';
    public $page;
    public $skip;
    public $perPage;
    public $search;
    public $previousSearch;
    public $allUsers;
    public $canLoadMore;


    public function mount($perPage = 4, $allUsers = []) {
        $this->perPage = $perPage;
        $this->allUsers = $allUsers;
    }

    public function nextPage() {
        $this->page = $this->page+1;
    }

    public function render()
    {
        $this->canLoadMore=true;
        if ($this->previousSearch == NULL || $this->previousSearch != $this->search) {
            $this->allUsers=[];
        }
        if (isset($this->search) && $this->search!=null) {
            $this->previousSearch = $this->search;
            $users = User::where("name", "LIKE","%".$this->search."%")->select(["id","name","about_me","location","profile_photo_path"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get()->toArray();
            $contador=0;
            foreach ($users as $user) {
                $posts = Review::where("id_user",$user["id"])->withCount('likers')->get();
                $likes=0;
                foreach($posts as $post) {
                    $likes+=$post->likers_count;
                }
                $users[$contador]["likes"]=$likes;
                $users[$contador]["reviews"]=CountProfile::reviews_count(User::find($user["id"]));;
                $contador++;
            }
            if (count($users)<$this->perPage) {
                $this->canLoadMore=false;
            }
            $this->allUsers[] = $users;
        }
        return view('livewire.show-users')->with('allUsers', $this->allUsers);
    }
}
