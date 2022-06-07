@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h1>Contacts</h1>
    <p>Hello this is contact!</p>

    @can('home.secret')
        <p>
            <a href="{{ route('secret') }}">
            Go to Special Contact Details
            </a>
        </p>
    @endcan
@endsection