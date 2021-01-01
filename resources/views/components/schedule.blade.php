<div>
    <h2 class="mb-4">Matches joués <small>{{ today()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</small></h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">
                <a href="{{request()->fullUrlWithQuery(['s'=>$sortStatsKey,'m'=>'played_at'])}}"
                               @if($sortMatchesKey === 'played_at') class="border-bottom" @endif>Date</a>
            </th>
            <th scope="col">
                <a href="{{request()->fullUrlWithQuery(['s'=>$sortStatsKey,'m'=>'home_team_name'])}}"
                @if($sortMatchesKey === 'home_team_name') class="border-bottom" @endif>Équipe visitée</a>
            </th>
            <th scope="col">
                <a href="{{request()->fullUrlWithQuery(['s'=>$sortStatsKey,'m'=>'home_team_goals'])}}"
                               @if($sortMatchesKey === 'home_team_goals') class="border-bottom" @endif>Goals <small>de
                        l’équipe visitée</small></a>
            </th>
            <th scope="col">
                <a href="{{request()->fullUrlWithQuery(['s'=>$sortStatsKey,'m'=>'away_team_goals'])}}"
                               @if($sortMatchesKey === 'away_team_goals') class="border-bottom" @endif>Goals <small>de
                        l’équipe visiteuse</small></a>
            </th>
            <th scope="col">
                <a href="{{request()->fullUrlWithQuery(['s'=>$sortStatsKey,'m'=>'away_team_name'])}}"
                               @if($sortMatchesKey === 'away_team_name') class="border-bottom" @endif>Équipe
                    visiteuse</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($matches as $match)
            <tr>
                <th scope="row">{{ $match->played_at->locale('fr')->isoFormat('dddd D MMMM YYYY à H:mm') }}</th>
                <td>{{ $match->home_team_name }}</td>
                <td>{{ $match->home_team_goals }}</td>
                <td>{{ $match->away_team_goals }}</td>
                <td>{{ $match->away_team_name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
