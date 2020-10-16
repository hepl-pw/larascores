<section class="mb-5">
    <h2 class="mb-4">Le classement <small>{{ today()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</small></h2>
    <div class="mb-5">
        <form class="row" action="/" method="get">
            <div class="col">
                <label for="competition">Competition</label>
                <select class="form-control" name="competition" id="competition">
                    @foreach($competitions as $competition)
                        <option value="{{$competition->id}}"
                                @if($competition->id === $competition_id) selected @endif>{{$competition->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="season">Season</label>
                <select class="form-control" name="season" id="season">
                    @foreach($span_years as $span_year)
                        <option value="{{$span_year->span_years}}"
                                @if($span_year->span_years === $season) selected @endif>{{$span_year->span_years}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Submit it</label>
                <button class="form-control">Change</button>
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Team</th>
            <th scope="col"><a href="/?s=games&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'games') class="border-bottom" @endif>Games</a></th>
            <th scope="col"><a href="/?s=points&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'points') class="border-bottom" @endif>Points</a></th>
            <th scope="col"><a href="/?s=wins&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'wins') class="border-bottom" @endif>Wins</a></th>
            <th scope="col"><a href="/?s=losses&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'losses') class="border-bottom" @endif>Losses</a></th>
            <th scope="col"><a href="/?s=draws&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'draws') class="border-bottom" @endif>Draws</a></th>
            <th scope="col"><a href="/?s=goals_for&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'goals_for') class="border-bottom" @endif>GF</a></th>
            <th scope="col"><a href="/?s=goals_against&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'goals_against') class="border-bottom" @endif>GA</a></th>
            <th scope="col"><a href="/?s=goals_difference&m={{ $sortMatchesKey??'played_at' }}"
                               @if($sortStatsKey === 'goals_difference') class="border-bottom" @endif>GD</a></th>
        </tr>
        </thead>
        <tbody>
        @foreach($teamsStats as $stat)
            <tr>
                <th scope="row">
                    @if(Auth::check())
                        @can('create','\App\Models\Team')
                            @if(count($stat->team->media))
                                <div class="logo-container"><img src="{{$stat->team->media->last()->getUrl()}}" alt="">
                                </div>@endif
                            <a href="{{route('change_team',['team'=>$stat->team->slug])}}">
                                {{ $stat->team->media->last() }}
                                {{ $stat->team->name }}
                            </a>
                        @endcan
                    @else
                        @if(count($stat->team->media))
                            <div class="logo-container"><img src="{{$stat->team->media->last()->getUrl()}}" alt="">
                            </div>@endif
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
