<div class="col">
    <label for="season">Season</label>
    <select class="form-control" name="season" id="season">
        @foreach($span_years as $span)
            <option value="{{$span}}"
                    @if($span == $season) selected @endif>{{$span}}</option>
        @endforeach
    </select>
</div>
