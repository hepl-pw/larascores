@extends('layouts.app')

@section('content')
    <div class="container">
        <x-team-form :teams="$teams"></x-team-form>
    </div>
@endsection
