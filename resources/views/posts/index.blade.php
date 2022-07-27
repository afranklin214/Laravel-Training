@extends('layouts.app')

@section('title', 'Blog Posts')


@section('content')
    @include('posts.partials.posts')
        {{-- <p class="text-muted">
            Added {{ $post->created_at->diffForHumans() }}
            by {{  $post->user->name }}
        </p>  --}}
     
    
    
@endsection