@extends('layouts.app')

@section('content')
    <div class="container">
        <x-match-form :teams="$teams"
                      :tournaments="$tournaments"></x-match-form>
    </div>
@endsection
