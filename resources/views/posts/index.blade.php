@extends('layouts.app')

@section('title', 'Blog Posts')


@section('content')
    @forelse ($posts as $key => $post )
        @include('posts.partials.posts')
        {{-- <p class="text-muted">
            Added {{ $post->created_at->diffForHumans() }}
            by {{  $post->user->name }}
        </p>  --}}
         
        @empty
        No posts found!
    @endforelse
@endsection