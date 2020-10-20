<div class="col">
    <label for="competition">Competition</label>
    <select class="form-control"
            name="competition"
            id="competition"
            wire:model="competition_id"
            wire:change="updateSeasonsSelect">
        @foreach($competitions as $competition)
            <option value="{{$competition->id}}">{{$competition->name}}</option>
        @endforeach
    </select>
</div>
