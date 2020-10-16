<div>
    <h2 class="pb-4">Add match</h2>
    <form action="{{ route('store_match') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="tournament">Tournament</label>
            <select class="form-control" name="tournament" id="tournament">
                @foreach($tournaments as $tournament)
                    <option value="{{$tournament->id}}">{{$tournament->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="played_at">Date du match - <small>jj/mm/aa hh:mm</small></label>
            <input class="form-control" type="text" id="played_at" name="played_at"
                   value="{{old('played_at',now()->locale('fr')->isoFormat('D/MM/YYYY HH:mm'))}}">
        </div>

        <!-- Home Team -->
        <div class="form-group">
            <label for="home-team">Équipe à domicile</label> @can('add-team') - <span><a href="{{ route('new_team') }}">Équipe non listée&nbsp;?</a></span>@endcan
            <select class="form-control" name="home-team" id="home-team">
                <option value="">-----</option>
                @foreach($teams as $team)
                    <option value="{{ $team->slug }}"
                            @if(old('home-team')===$team->slug) selected @endif>{{$team->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="home-team-goals">Goals de l’équipe à domicile</label>
            <input class="form-control" type="number" step="1" value="{{old('home-team-goals',0)}}" id="home-team-goals"
                   name="home-team-goals">
        </div>


        <!-- Away Team -->
        <div class="form-group">
            <label for="away-team">Équipe visiteuse</label> @can('add-team') - <span><a href="{{ route('new_team') }}">Équipe non listée&nbsp;?</a></span>@endcan
            <select class="form-control" name="away-team" id="away-team">
                <option value="">-----</option>
                @foreach($teams as $team)
                    {{old('away-team')}}
                    <option value="{{ $team->slug }}"
                            @if(old('away-team')===$team->slug) selected @endif>{{$team->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="away-team-goals">Goals de l’équipe visiteuse</label>
            <input class="form-control" type="number" step="1" value="{{old('away-team-goals',0)}}" id="away-team-goals"
                   name="away-team-goals">
        </div>

        <button class="btn btn-primary" type="submit">Ajouter ce match</button>
    </form>
    @if(count($errors->all()))
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
