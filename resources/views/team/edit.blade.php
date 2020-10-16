@extends('layouts.app')

@section('content')
    <div class="container">
        <x-team-edit-form :team="$team"></x-team-edit-form>
    </div>
@endsection
