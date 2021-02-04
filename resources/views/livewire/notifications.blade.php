<div>
    <li class="nav-item">
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
           New Episodes 
           @if($newEpisode)
	           <span class="badge badge-bill badge-danger">
	           	NEW
	           </span>
	        @endif
           <span class="caret"></span></button>
        </button>
        <ul class="dropdown-menu">
        	@if($newEpisode)
        		<li style="text-align: center; margin-bottom: 5px;">
        			<a href="{{$episode_link}}">{{$anime_title}} episode {{$episode_no}}</a>
        		</li>
        	@else
            	<li style="text-align: center; margin-bottom: 5px;">No New Episodes</li>
            @endif
        </ul>
    </li>
</div>
