<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\TeamStat;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
         * The main purpose of this method is to display the standings and the matches already played.
         *
         * Both tables are filled with data depending of the tournament chosen
         *
         * A tournament is the combination of a competition and a season. Not all competition have all
         * seasons, so the seasons selector's available options depend of the competition selector
         * selected option. The competition selector is always filled with all competition, even if the
         * currently selected season has no related competition. The interface must handle this
         * particular case by sending a 404 response.
         *
         * Furthermore, the standings and the matches are sortable by any header in their HTML tables
         * The standings are sortable with two criteria. 'Points' is always the second criteria except
         * if he is the first one. In this case, the 'goals difference' is used as a secondary key.
         * By default, 'points' is the first criteria. For the matches, it's 'played_at'
         *
         * For user experience reasons, changing the sort order of one table can not change the sort
         * order of the other one.
         *
         * So, there is a 'state' defining the way the matches and the standings are retrieved.
         *
         * This state must include :
         *
         * - the competition identifier
         * - the season identifier
         * - the tournament is retrieved form these information or a 404 response is sent to the browser
         * - the teamsStats are the standings of the chosen tournament
         * - the matches are the matches of the chosen tournament
         */

        /*
         * First let’s validate the incoming inputs. A lot of work can be done
         * here by the framework thanks to just a few rules. Just great 🤩
         * TODO: Improve enumeration of the fields for m and s. Could be a config value
         */
        $validatedRequestData = $request->validate([
            'competition' => 'bail|required_with:season|exists:competitions,id',
            'season' => [
                'required_with:competition',
                Rule::exists('tournaments', 'span_years')
                    ->where(function ($query) {
                        $query->where('competition_id', request('competition'));
                    })
            ],
            'm' => 'in:played_at,home_team_name,home_team_goals,away_team_goals,away_team_name|required_with:s',
            's' => 'in:games,points,wins,losses,draws,goals_for,goals_against,goals_difference|required_with:m'
        ]);

        /*
         * Setting the tournament
         *
         * After validation of competition and season, a tournament is selected
         * I nothing valid is provided, the first one in database is selected
         * TODO : default values should come from config
         */

        if (isset($validatedRequestData['competition'])) {
            $competition = Competition::find($validatedRequestData['competition']);
            $season = $validatedRequestData['season'];
            $tournament = Tournament::with([
                'competition',
                'participations.match.teams',
                'participations.team.matches'
            ])
                ->where('span_years', $season)
                ->where('competition_id', $competition->id)
                ->firstOrFail();
        } else {
            $tournament = Tournament::with([
                'competition',
                'participations.match.teams',
                'participations.team.matches'
            ])
                ->firstOrFail();
            $competition = $tournament->competition;
            $season = $tournament->span_years;
        }


        /*
         * Setting the sort keys
         * TODO: default values should come from config
         */

        $sortStatsKey = $validatedRequestData['s'] ?? 'points';
        $secondaryKey = $sortStatsKey !== 'points' ? 'points' : 'goals_difference';
        $sortMatchesKey = $validatedRequestData['m'] ?? 'played_at';


        // Fetching matches according to selected tournament
        $matches = $tournament->matches($sortMatchesKey);

        // Fetching stats according to selected tournament
        $teamsStats = TeamStat::with('team')
            ->where('tournament_id', $tournament->id)
            ->orderByDesc($sortStatsKey)
            ->orderByDesc($secondaryKey)
            ->get();


        /*
         * In order to provide datas for the two selects, we need to
         * fetch an array of span_years (fi: 2020-2021) and an array
         * of all the competitions from the database
         *
         * Let’s start with the span_years. We have to select those
         * available for the selected competition if there is one and
         * all if there isn’t.
         */

        if (isset($validatedRequestData['competition'])) {
            $span_years = $tournament
                ->competition
                ->span_years;
        } else {
            $span_years = Tournament::orderBy('span_years')
                ->get()
                ->unique('span_years')
                ->pluck('span_years');
        }

        /*
        * Now, just fetch all competitions from the database
        */
        $competitions = Competition::orderBy('name')
            ->get();


        /*
         * Let’s prepare this big set of data, our state, for the view.
         * Since this will be used in components, it doesn’t matter at
         * this point to provide individual variables. We’ll fetch them
         * at the component level
         */

        $data = compact('matches',
            'teamsStats',
            'sortStatsKey',
            'sortMatchesKey',
            'span_years',
            'competitions',
            'competition',
            'season'
        );

        /*
         * Time to render the view with these data
         */
        return view('dashboard')->withData($data);
    }
}
