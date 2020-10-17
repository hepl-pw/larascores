@if(count($team->media))
    <div class="logo-container"><img src="{{$team->media->last()->getUrl()}}" alt=""></div>
@endif
