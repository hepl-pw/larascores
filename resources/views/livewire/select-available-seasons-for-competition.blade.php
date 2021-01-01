<div class="col">
    <label for="season">Season</label>
    <select class="form-control"
            name="season"
            id="season"
            wire:model="season"
    >
        @foreach($span_years as $span)
            <option value="{{$span}}">{{$span}}</option>
        @endforeach
    </select>
</div>
