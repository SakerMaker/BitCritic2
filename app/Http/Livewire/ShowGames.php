<?php

namespace App\Http\Livewire;

use Livewire\Component;
use MarcReichel\IGDBLaravel\Enums\Image\Size;
use MarcReichel\IGDBLaravel\Models\Genre;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Cover;
use App\Traits\CountGame;
use Illuminate\Http\Client\Pool;

class ShowGames extends Component
{

    use CountGame;
    protected $paginationTheme = 'bootstrap';
    public $page = 1;
    public $skip;
    public $perPage;
    public $search;
    public $canSearch;
    public $allGames;
    public $columns;

    public function mount($perPage = 9, $search = "", $canSearch = false, $allGames = [], $columns = 3) {
        $this->perPage = $perPage;
        $this->search = $search;
        $this->canSearch = $canSearch;
        $this->allGames = $allGames;
        $this->columns = $columns;
    }

    public function nextPage() {
        $this->page = $this->page+1;
    }
    // public function previousPage() {
    //     $this->page = $this->page-1;
    // }
    
    public static function renderImages($game) {
        $results = null;
        $pool = new Pool();


        $pool[] = async(function () {
            $cover = Cover::find($game["cover"]);
            $games[$contador]["cover"]=$cover->getUrl(Size::COVER_BIG, true);
        })->then(function ($output) {
            $results=$output;
        });

        await($pool);
    }

    public function render() {
        $igdb = new IGDB("games");
        if (isset($this->search) && $this->search!=null) {
            $games = $igdb->search($this->search)->whereNotNull("total_rating_count")->orderBy("total_rating_count", "desc")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
        } else {
            $games = $igdb->whereNotNull("total_rating_count")->orderBy("total_rating_count", "desc")->select(["id","name","genres","summary","first_release_date","cover","total_rating_count"])->take((int)$this->perPage)->skip((int)$this->perPage * (int)$this->page)->get();
        }
        

        $contador=0;
        foreach ($games as $game) {
            if (isset($game["cover"])) {
                $this->renderImages($game);
            } else {
                $games[$contador]["cover"]="img/BitCritic-No-Game-Cover-View-Game-Review-Community-S.png";
            }
            if (isset($game["genres"])) {
                for ($i = 0;$i<count($game["genres"]);$i++) {
                    $genres[$i]=Genre::select(["name"])->find($game["genres"][$i]);
                    $genres[$i]=$genres[$i]->name;
                }
                $games[$contador]["genres"]=array_unique($genres);
            }
            $games[$contador]["reviews"]=CountGame::reviews_count($game["id"]);
            $contador++;
        }

        $this->allGames[] = $games;

        return view('livewire.show-games')->with('allGames', $this->allGames);
    }
}
