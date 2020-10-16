<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A new Team has been created</title>
</head>
<body>
<h1>Hello ! A new team has been created</h1>
<h2>Details</h2>
<ul>
    <li>Name : {{$team->name}}</li>
    <li>Slug : {{$team->slug}}</li>
    @if($team->file_name)
        <li>logo : <img src="{{asset($team->file_name)}}" alt=""></li>
    @endif
</ul>
</body>
</html>
