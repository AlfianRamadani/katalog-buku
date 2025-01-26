@extends('layout.app')

@section('title', 'Home Page')

@section('content')
    @include('home.partial.search')

    {{-- <x-card :img="$cardData['img']" /> --}}
    <x-card />

@endsection
