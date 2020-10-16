@extends('layouts.app')

@section('content')
    <div class="container">
        <x-standings :teamsStats="$teamsStats"
                     :sortStatsKey="$sortStatsKey"
                     :sortMatchesKey="$sortMatchesKey"
                     :spanYears="$span_years"
                     :competitions="$competitions"
                     :competitionId="$competition_id"
                     :season="$season"
        ></x-standings>
        <hr>
        <x-schedule :matches="$matches"
                    :sortStatsKey="$sortStatsKey"
                    :sortMatchesKey="$sortMatchesKey"
        ></x-schedule>
        <hr>
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
