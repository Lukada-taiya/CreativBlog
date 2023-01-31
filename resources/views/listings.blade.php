@extends('layout')
@section('content')
    <h2>Listings<h2>
    @if (count($listings) == 0)
        <p>No Listings Found</p>
    @else
        @foreach ($listings as $listing)
        <h3><a href="{{ $listing->id }}"> {{ $listing->title }}</a></h3>
        <p>{{ $listing->description }}</p>
    @endforeach
    @endif
@endsection

    