<div>
    <h2 class="pb-4">Add team</h2>
    <div class="row">
        <section class="col">
            <h3>Les équipes déjà listées</h3>
            @if($teams)
                <ul>
                    @foreach($teams as $team)
                        <li class="teams-logos">
                            @include('partials.team.team-logo-45')
                            <a href="{{route('change_team',['team'=>$team->slug])}}">{{$team->name}}</a> -
                            <small>{{$team->slug}}</small></li>
                    @endforeach
                </ul>
                <p>The team is already listed, i want to <a href="{{ route('new_match') }}">add a match</a></p>
            @endif
        </section>
        <section class="col-8">
            <form action="{{ route('store_team') }}"
                  method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nom de l’équipe</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="slug">Abbréviation du nom en 3 caractères</label>
                    <input class="form-control" type="text" id="slug" name="slug" maxlength="3"
                           value="{{ old('slug') }}">
                </div>
                <div class="form-group">
                    <label for="logo">Logo de l’équipe (un SVG)</label>
                    <input class="form-control-file" type="file" name="logo" id="logo">
                </div>

                <button class="btn btn-primary" type="submit">Ajouter cette équipe</button>

            </form>
            @if(count($errors->all()))
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
</div>
