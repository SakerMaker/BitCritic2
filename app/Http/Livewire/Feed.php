<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\User;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Genre;
use App\Traits\CountGame;
use Illuminate\Support\Facades\Auth;
use MarcReichel\IGDBLaravel\Enums\Image\Size;

class Feed extends Component
{
    public $following;
    public $user;
    public $page;
    public $skip;
    public $perPage;
    public $canLoadMore;
    public $globalReviews;

    public function mount($perPage=12, $canLoadMore = true, $globalReviews = []) {
        $this->following=Auth::user()->followings;
        $this->perPage = $perPage;
        $this->canLoadMore = $canLoadMore;
        $this->globalReviews = $globalReviews;
    }

    public function nextPage() {
        $this->page = $this->page+1;
        
    }

    public function render()
    {
        $this->canLoadMore=false;
        if (!empty($this->following[0])) {
            $this->canLoadMore=true;
            
            $igdb = new IGDB("games");
            $users_id=[];
            $users=[];
            foreach ($this->following as $following) {
                $users_id[]=$following->followable_id;
            }
            $allreviews=Review::whereIn("id_user",$users_id)->orderByDesc("updated_at")->take((int)$this->perPage)->skip((int)$this->perPage*(int)$this->page)->get();
            

            $games=[];
            if (!empty($allreviews->toArray())) {
                
                $likes_id=[];
                foreach ($allreviews as $review) {
                    $likes_id[]=$review->totalLikes;
                }

                $games_id=[];
                foreach ($allreviews as $review) {
                    $games_id[]=$review->id_game;
                    $users[]=User::find($review->id_user)->toArray();
                }
                if (count(array_unique($games_id))!=count($games_id)) {
                    $dups = array();
                    foreach(array_count_values($games_id) as $val => $c)
                        if($c > 1) $dups[] = $val;

                    $games=$igdb->whereIn("id",$games_id)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take(count($allreviews)-count($dups))->get();
                    $games=array_merge($games,$igdb->whereIn("id",$dups)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take(count($allreviews)-count(array_unique($games_id)))->get());
                } else {
                    $games=$igdb->whereIn("id",$games_id)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take(count($allreviews))->get();
                }

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
                $allCovers = Cover::whereIn("game", $covers["cover"])->take(count($allreviews))->get();
                
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
            if (count($allreviews)<$this->perPage) {
                $this->canLoadMore=false;
            }
    
    
            $allreviews = $allreviews->toArray();

            $contador=0;
            foreach ($allreviews as $review) {
                $allreviews[$contador]["likes"]=Review::find($review["id"])->totalLikers;
                $contador++;
            }
    
            $temp = array_column($allreviews, "id_game");
            array_multisort($temp, SORT_ASC, $allreviews);
            
            $contador=0;
            foreach ($allreviews as $review) {
                $allreviews[$contador]["games"]=$games[$contador];
                $contador++;
            }
    
            $temp = array_column($allreviews, "id_user");
            array_multisort($temp, SORT_ASC, $allreviews);
            
            
            
            $temp = array_column($users, "id");
            array_multisort($temp, SORT_ASC, $users);
    
            $contador=0;
            foreach ($allreviews as $review) {
                $allreviews[$contador]["user"]=$users[$contador];
                $contador++;
            }
    
            $temp = array_column($allreviews, "updated_at");
            array_multisort($temp, SORT_DESC, $allreviews);
            $this->globalReviews[]=$allreviews;
        }

        
        


        return view('livewire.feed')->with("allreviews",$this->globalReviews);
    }
}
