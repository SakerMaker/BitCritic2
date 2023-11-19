<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\User;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Genre;
use App\Traits\CountGame;
use MarcReichel\IGDBLaravel\Enums\Image\Size;

class Feed extends Component
{
    public $following;
    public $user;
    public $page;
    public $skip;
    public $perPage;
    public $canLoadMore;

    public function mount($user=0, $perPage=12, $canLoadMore = true) {
        $this->following=User::find($user)->followings;
        $this->perPage = $perPage;
        $this->canLoadMore = $canLoadMore;
    }

    public function nextPage() {
        $this->page = $this->page+1;
    }

    public function render()
    {
        $this->canLoadMore=true;
        if (!empty($this->following[0])) {
            $igdb = new IGDB("games");
            $users_id=[];
            $users=[];
            foreach ($this->following as $following) {
                $users_id[]=$following->id;
            }
            $allreviews=Review::whereIn("id_user",$users_id)->take((int)$this->perPage)->skip((int)$this->perPage*$this->page)->get();
            $games=[];
            if (!empty($allreviews->toArray())) {
                
                $games_id=[];
                foreach ($allreviews as $review) {
                    $games_id[]=$review->id_game;
                    $users[]=User::find($following->id);
                }
                $games=$igdb->whereIn("id",$games_id)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * $this->page)->get();
    
                $covers["cover"]=[];
                if ($games!=NULL) {
                    $contador=0;
                    foreach ($games as $game) {
                        if (isset($game["genres"])) {
                            for ($i = 0;$i<count($game["genres"]);$i++) {
                                $genres[$i]=Genre::select(["name"])->find($game["genres"][$i]);
                                $genres[$i]=$genres[$i]->name;
                            }
                            $games[$contador]["genres"]=array_unique($genres);
                        }
                        $games[$contador]["reviews"]=CountGame::reviews_count($game["id"]);
                        if (isset($game["cover"])) {
                            $covers["cover"][]=$game["id"];
                            $games[$contador]["hasCover"]=true;
                        } else {
                            $covers["cover"][]=0;
                            $games[$contador]["cover"]="img/BitCritic-No-Game-Cover-View-Game-Review-Community-S.png";
                            $games[$contador]["hasCover"]=false;
                        }
                        $contador++;
                    }
                }
                $allCovers = Cover::whereIn("game", $covers["cover"])->take(count($covers["cover"]))->get();
                
                foreach ($allCovers as $cover) {
                    $contador=0;
                    foreach ($games as $game) {
                        if ($game["hasCover"] && $game["id"] == $cover["game"]) {
                            $games[$contador]["cover"]=$cover->getUrl(Size::COVER_BIG, true);
                        }
                        $contador++;
                    }
                }
            }
        }
        
        if (count($allreviews)<$this->perPage) {
            $this->canLoadMore=false;
        }


        $allreviews = array_reverse($allreviews->toArray());
        return view('livewire.feed')->with("allreviews",$allreviews)->with("games",$games)->with("users",$users);
    }
}
