@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1> {{ $post->title }}</h1>
            @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)
                <span>
                    Brand New Post!
                </span>
            @endif
            <p>{{ $post->content }}</p>
            <p>Added {{ $post->created_at->diffForHumans() }}</p>
    
            {{-- <x-updated :date="$post->created_at" :userId="$post->user->id" :name="$post->user->name" /> --}}
            
            <x-tags :tags="$post->tags" />
            
            <p>Currently read by {{ $counter }} people</p>
            <h4>Comments</h4>

            @include('comments._form')
    
            @forelse($post->comments as $comment)
                <p>
                    {{ $comment->content }}, added {{ $comment->created_at->diffForHumans()}}
                </p>
            @empty
                <p>No comments yet!</p>
            @endforelse
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>

</div>
@endsection