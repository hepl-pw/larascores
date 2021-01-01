@extends('layouts.app')

@section('content')

    <div class="container">
        {{$errors->first()}}
        @livewire('standings',$data)
        @canany(['add-match', 'add-team'])
            <nav>
                <h2>Administration des matches et des équipes</h2>
                <ul>
                    @can('add-match')
                        <li><a href="{{route('new_match')}}">Ajouter un match</a></li>
                    @endcan
                    @can('add-team')
                        <li><a href="{{route('new_team')}}">Ajouter une équipe</a></li>
                    @endcan
                </ul>
            </nav>
        @endcanany
    </div>
@endsection
