<?php

namespace App\Http\Livewire;

use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Genre;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use App\Traits\CountGame;
use MarcReichel\IGDBLaravel\Enums\Image\Size;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Game;

class ShowGames extends Component
{

    use CountGame;
    protected $paginationTheme = 'bootstrap';
    public $page;
    public $skip;
    public $perPage;
    public $search;
    public $previousSearch;
    public $canSearch;
    public $allGames;
    public $columns;
    public $canLoadMore;
    public $canLoadButton;
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($perPage = 9, $search = "", $canSearch = false, $allGames = [], $columns = 3, $canLoadMore = true, $canLoadButton = true) {
        $this->perPage = $perPage;
        $this->search = $search;
        $this->canSearch = $canSearch;
        $this->allGames = $allGames;
        $this->columns = $columns;
        $this->canLoadMore = $canLoadMore;
        $this->canLoadButton = $canLoadButton;
    }

    public function nextPage() {
        $this->page = $this->page+1;

    }

    public function render() {
        $igdb = new IGDB("games");
        $this->canLoadMore=true;

        
        if (isset($this->search) && $this->search!=null) {
            if ($this->previousSearch == NULL || $this->previousSearch != $this->search) {
                $this->allGames=[];
            }
            $this->previousSearch = $this->search;
            
            // $games = $igdb->search($this->search)->whereNotNull("total_rating_count")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take(4)->get();
            // $gamesIds=[];
            // foreach ($games as $game) {
            //     $gamesIds[]=$game["id"];
            // }
            // if (!empty($gamesIds)) {
            //     $games += $igdb->fuzzySearch(["name"], $this->search, false)->whereNotIn("id",$gamesIds)->whereNotNull("total_rating_count")->orderBy("total_rating_count", "desc")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
            // } else {
            //     $games = $igdb->fuzzySearch(["name"], $this->search, false)->whereNotNull("total_rating_count")->orderBy("total_rating_count", "desc")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
            // }
            // $games += $igdb->fuzzySearch(["name"], $this->search, false)->whereNull("total_rating_count")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
            $games = $igdb->where("name",$this->search)->whereNotNull("total_rating_count")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
            $gamesIds=[0];
            foreach ($games as $game) {
                $gamesIds[]=$game["id"];
            }
            $perActualPage = $this->perPage;
            $perActualPage=$perActualPage-count($gamesIds);
            if ($perActualPage>0) {
                $games += $igdb->whereLike("name",$this->search."%", false)->whereNotNull("total_rating_count")->whereNotIn("id",$gamesIds)->orderBy("total_rating_count", "desc")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
                $gamesIds=[0];
                foreach ($games as $game) {
                    $gamesIds[]=$game["id"];
                }
            }
            $perActualPage=$this->perPage;
            $perActualPage=$perActualPage-count($gamesIds);
            if ($perActualPage>0) {
                $games += $igdb->whereLike("name","%".$this->search."%", false)->whereNotNull("total_rating_count")->orderBy("total_rating_count", "desc")->whereNotIn("id",$gamesIds)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
                $gamesIds=[0];
                foreach ($games as $game) {
                    $perActualPage--;
                    $gamesIds[]=$game["id"];
                }
            }
            $perActualPage = $this->perPage;
            $perActualPage=$perActualPage-count($gamesIds);
            if ($perActualPage>0) {
                $games += $igdb->where("name",$this->search)->whereNull("total_rating_count")->whereNotIn("id",$gamesIds)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
                $gamesIds=[0];
                foreach ($games as $game) {
                    $gamesIds[]=$game["id"];
                }
            }
            $perActualPage=$this->perPage;
            $perActualPage=$perActualPage-count($gamesIds);
            if ($perActualPage>0) {
                $games += $igdb->whereLike("name",$this->search."%", false)->whereNull("total_rating_count")->whereNotIn("id",$gamesIds)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
                $gamesIds=[0];
                foreach ($games as $game) {
                    $perActualPage--;
                    $gamesIds[]=$game["id"];
                }
            }
            $perActualPage=$this->perPage;
            $perActualPage=$perActualPage-count($gamesIds);
            if ($perActualPage>0) {
                $games += $igdb->whereLike("name","%".$this->search."%", false)->whereNull("total_rating_count")->whereNotIn("id",$gamesIds)->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
                $gamesIds=[0];
                foreach ($games as $game) {
                    $perActualPage--;
                    $gamesIds[]=$game["id"];
                }
            }
            // $perActualPage=$this->perPage;
            // $perActualPage=$perActualPage-count($gamesIds);
            // if ($perActualPage>0) {
            //     $games += $igdb->fuzzySearch(["name"], $this->search, false)->whereNotIn("id",$gamesIds)->whereNotNull("total_rating_count")->orderBy("total_rating_count", "desc")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
            //     $gamesIds=[0];
            //     foreach ($games as $game) {
            //         $perActualPage--;
            //         $gamesIds[]=$game["id"];
            //     }
            // }
            // $perActualPage=$this->perPage;
            // $perActualPage=$perActualPage-count($gamesIds);
            // if ($perActualPage>0) {
            //     $games += $igdb->fuzzySearch(["name"], $this->search, false)->whereNull("total_rating_count")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
            // }
        } else {
            if ($this->previousSearch != null) {
                $this->allGames=[];
            }
            $games = $igdb->whereNotNull("total_rating_count")->orderBy("total_rating_count", "desc")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
            $games += $igdb->whereNull("total_rating_count")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
        }
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
            
            $allCovers = Cover::whereIn("game", $covers["cover"])->take(count($covers["cover"]))->get();
            
            if (count($games)<$this->perPage) {
                $this->canLoadMore=false;
            }
            
            foreach ($allCovers as $cover) {
                $contador=0;
                foreach ($games as $game) {
                    if ($game["hasCover"] && $game["id"] == $cover["game"]) {
                        $games[$contador]["cover"]=$cover->getUrl(Size::COVER_BIG, true);
                    }
                    $contador++;
                }
            }
        } else {
            $this->canLoadMore=false;
        }
        

        
        

        $this->allGames[] = $games;
        $this->allGames = array_unique($this->allGames, SORT_REGULAR);
        
        return view('livewire.show-games')->with('allGames', $this->allGames);
    }
}
