<section class="mb-5">
    <h2 class="mb-4"><img src="{{ $tournament->media->last()->getUrl() }}" height="100"> Le classement
        <small>{{ today()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</small></h2>
    <div class="mb-5">
        @include('partials.forms.tournament-selection')
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Team</th>
            <th scope="col"><a href="{{request()->fullUrlWithQuery(['s'=>'games','m'=>$sortMatchesKey??'played_at'])}}"
                               @if($sortStatsKey === 'games') class="border-bottom" @endif>Games</a></th>
            <th scope="col"><a href="{{request()->fullUrlWithQuery(['s'=>'points','m'=>$sortMatchesKey??'played_at'])}}"
                               @if($sortStatsKey === 'points') class="border-bottom" @endif>Points</a></th>
            <th scope="col"><a href="{{request()->fullUrlWithQuery(['s'=>'wins','m'=>$sortMatchesKey??'played_at'])}}"
                               @if($sortStatsKey === 'wins') class="border-bottom" @endif>Wins</a></th>
            <th scope="col"><a href="{{request()->fullUrlWithQuery(['s'=>'losses','m'=>$sortMatchesKey??'played_at'])}}"
                               @if($sortStatsKey === 'losses') class="border-bottom" @endif>Losses</a></th>
            <th scope="col"><a href="{{request()->fullUrlWithQuery(['s'=>'draws','m'=>$sortMatchesKey??'played_at'])}}"
                               @if($sortStatsKey === 'draws') class="border-bottom" @endif>Draws</a></th>
            <th scope="col"><a
                        href="{{request()->fullUrlWithQuery(['s'=>'goals_for','m'=>$sortMatchesKey??'played_at'])}}"
                        @if($sortStatsKey === 'goals_for') class="border-bottom" @endif>GF</a></th>
            <th scope="col"><a
                        href="{{request()->fullUrlWithQuery(['s'=>'goals_against','m'=>$sortMatchesKey??'played_at'])}}"
                        @if($sortStatsKey === 'goals_against') class="border-bottom" @endif>GA</a></th>
            <th scope="col"><a
                        href="{{request()->fullUrlWithQuery(['s'=>'goals_difference','m'=>$sortMatchesKey??'played_at'])}}"
                        @if($sortStatsKey === 'goals_difference') class="border-bottom" @endif>GD</a></th>
        </tr>
        </thead>
        <tbody>
        @foreach($teamsStats as $stat)
            <tr>
                <th scope="row">
                    @if(Auth::check())
                        @can('create','\App\Models\Team')
                            <x-team-logo :team="$stat->team"></x-team-logo>
                            <a href="{{route('change_team',['team'=>$stat->team->slug])}}">
                                {{ $stat->team->name }}
                            </a>
                        @endcan
                    @else
                        <x-team-logo :team="$stat->team"></x-team-logo>
                        {{ $stat->team->name }}
                    @endif
                </th>
                <td>{{ $stat->games }}</td>
                <td>{{ $stat->points }}</td>
                <td>{{ $stat->wins }}</td>
                <td>{{ $stat->losses }}</td>
                <td>{{ $stat->draws }}</td>
                <td>{{ $stat->goals_for }}</td>
                <td>{{ $stat->goals_against }}</td>
                <td>{{ $stat->goals_difference }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
