<form class="row" action="{{route('dashboard')}}" method="get">
    <div class="col">
        <label for="competition">Competition</label>
        <select class="form-control" name="competition" id="competition">
            @foreach($competitions as $competition)
                <option value="{{$competition->id}}"
                        @if($competition->id == $competition_id) selected @endif>{{$competition->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <label for="season">Season</label>
        <select class="form-control" name="season" id="season">
            @foreach($span_years as $span_year)
                <option value="{{$span_year->span_years}}"
                        @if($span_year->span_years == $season) selected @endif>{{$span_year->span_years}}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
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
