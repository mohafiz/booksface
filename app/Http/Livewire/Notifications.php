<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\anime;

class Notifications extends Component
{
    public $newEpisode = false;

    public $anime_title;
    public $episode_no;
    public $episode_link;

	protected $listeners = ['echo:episode,episodeAdded' => 'newEpisodeAdded'];

    public function render()
    {
        return view('livewire.notifications');
    }

    public function newEpisodeAdded($e)
    {
        $this->newEpisode = true;

    	$episode = $e['episode'];

    	$slug    = anime::find($episode['anime_id'])->slug;

    	$this->anime_title  = anime::find($episode['anime_id'])->title;
    	$this->episode_no   = $episode['episode_no'];
    	$this->episode_link = url($slug.'/watch?episode='.$episode['episode_no']);
    }
}
