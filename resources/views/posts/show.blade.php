@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <div class="row">
        <div class="col-6">

            @if($post->image)
                <div style="min-height: 500px; color: rgb(101, 62, 241); text-align: center; background-attachment: fixed;">
                    <img src="http://127.0.0.1:8000/storage/{{ $post->image->path }}" style="max-height: 250px" />
                    <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">

            @else
                <h1>

            @endif

            <h1> {{ $post->title }}</h1>
            @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)
                <span>
                    Brand New Post!
                </span>
            @endif

            @if($post->image)
                    </h1>
                </div>
            @else
                </h1>
            @endif
            <p>{{ $post->content }}</p>
            
            {{-- <img src="{{ $post->image->url() }}" /> --}}
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


@endsection