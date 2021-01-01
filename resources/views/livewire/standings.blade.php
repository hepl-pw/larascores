<div>
    <x-standings :teamsStats="$teamsStats"
                 :sortStatsKey="$sortStatsKey"
                 :sortMatchesKey="$sortMatchesKey"
                 :spanYears="$span_years"
                 :competitions="$competitions"
                 :competition="$competition"
                 :competitionId="$competition->id"
                 :season="$season"
    ></x-standings>
    <hr>
    <x-schedule :matches="$matches"
                :sortStatsKey="$sortStatsKey"
                :sortMatchesKey="$sortMatchesKey"
    ></x-schedule>
    <hr>
</div>
