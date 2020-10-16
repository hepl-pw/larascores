# Larascores

An app meant to help learn Laravel. 

At this point, the front-end displays a dashboard. The dashboard displays the standings for a tournament and the matches played. The visitor can choose between some tournaments and two tables are sortable in various ways.

There are also two kinds of roles for logged users. The admin can add teams and matches. The team-manager can add matches but not teams. I plan to use Spatie’s permissions package but it’s not yet implemented in this project.

The models listed in the application are :

- Team :  
    - name ;
    - slug ; 
- Match : 
    - date and time of the match ;
    - slug of the match, constituted by the slug of the home team followed by the slug of the away team, like CHEARS for Chelsea-Arsenal.
- Participation : one might argue that a football game is always about two teams, and only two teams. So it is tempting, and that’s quite usual in almost every design found on the Internet, to include a home_team_id and an away_team_id in the Match table. That's not the case in this design. It tends towards normalisation and so, the relationship between the matches and the teams is represented by the concept of *participation*. It's a bit more challenging at the application level, and that's also a reason for this choice since the app is meant to learn Laravel and Eloquent. In a participation, one can find :
    - team_id ;
    - match_id ;
    - goals_scored ;
    - is_home ;
    - tournament_id.
- Competition : 
    - name ;
    - slug.
- Tournament : was wondering how to represent the beginning and the end of the season. Finally, i’ve chosen to note it arbitrarily instead of deducing it from the actual matches dates because IRL it might be independent. The year_span is an administrative information, an almost arbitrary label. It might happen, for whatever reason, that a match is played anticipatively or is delayed and is nonetheless included in a tournament.
    - competition_id
    - span_years (fi : 2020-2021)
- Media : at this point, the app uses Spatie’s media-library. It allows the linking of media files to models and provides an expressive API to handle the files, including image conversions. So the files are referenced in this Media model and linked to other models through polymorphic relationships.
