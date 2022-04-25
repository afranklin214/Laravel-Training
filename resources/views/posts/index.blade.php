@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    @forelse ($posts as $key => $post )
        @include('posts.partials.posts')
        
        @empty
        No posts found!
    @endforelse
@endsection