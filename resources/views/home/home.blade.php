@extends('layout.app')

@section('title', 'Home Page')

@section('content')
    @include('home.partial.search')
    <div class="grid grid-cols-5 gap-4 items-center justify-center">
        <x-card />
    </div>

@endsection
