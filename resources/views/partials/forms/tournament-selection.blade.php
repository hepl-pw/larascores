<form class="row" action="{{route('dashboard')}}" method="get">
    @livewire('select-available-competitions-for-season', ['competitions'=>$competitions,
    'competition'=>$competition,'competitionId'=>$competition->id])
    @livewire('select-available-seasons-for-competition', ['span_years'=>$span_years, 'season'=>$season])
    <div class="col js">
        <label>Submit it</label>
        <button class="form-control">Change</button>
    </div>
    @if(request()->query('s'))
        <input type="hidden" name="s" value="{{request()->query('s')}}">
    @endif
    @if(request()->query('m'))
        <input type="hidden" name="m" value="{{request()->query('m')}}">
    @endif
</form>
