<div>
    <h2 class="pb-4">Edit {{$team->name}}  @if($team->file_name)<img src="{{asset($team->file_name)}}" alt="">@endif
    </h2>
    <div class="row">
        <section class="col-8">
            <form action="{{ route('update_team',['team'=>$team->id]) }}"
                  method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Nom de l’équipe</label>
                    <input class="form-control" type="text"
                           id="name" name="name"
                           value="{{ old('name')??$team->name }}">
                </div>
                <div class="form-group">
                    <label for="slug">Abbréviation du nom en 3 caractères</label>
                    <input class="form-control" type="text"
                           id="slug" name="slug" maxlength="3"
                           value="{{ old('slug')??$team->slug }}">
                </div>
                <div class="form-group">
                    @if($team->file_name)<img src="{{asset($team->file_name)}}" alt="">@endif
                    <label for="logo">Logo de l’équipe (un png) - ne rien sélectionner si il est déjà bon</label>
                    <input class="form-control-file" type="file" name="logo" id="logo">
                </div>

                <button class="btn btn-primary" type="submit">Mettre cette équipe à jour</button>

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
