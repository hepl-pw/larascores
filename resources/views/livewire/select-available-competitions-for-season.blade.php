<div class="col">
    <label for="competition">Competition</label>
    <select class="form-control"
            name="competition"
            id="competition"
            wire:model="competitionId"
    >
        @foreach($competitions as $comp)
            <option value="{{$comp->id}}" @if($comp->id===$competition->id) selected @endif>{{$comp->name}}</option>
        @endforeach
    </select>
</div>
