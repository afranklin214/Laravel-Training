@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1> {{ $post->title }}</h1>
    @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)
        <span>
            Brand New Post!
        </span>
    @endif
    <p>{{ $post->content }}</p>
    <p>Added {{ $post->created_at->diffForHumans() }}</p>

    
    <h4>Comments</h4>

    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}, added {{ $comment->created_at->diffForHumans()}}
        </p>
    @empty
        <p>No comments yet!</p>
    @endforelse
@endsection