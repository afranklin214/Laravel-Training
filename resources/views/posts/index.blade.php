@extends('layouts.app')

@section('title', 'Blog Posts')


@section('content')
    <div class="row">
        <div class="col-8">
            @forelse ($posts as $key => $post )
            @include('posts.partials.posts')
                {{-- <p class="text-muted">
                Added {{ $post->created_at->diffForHumans() }}
                by {{  $post->user->name }}
            </p>  --}}
     
             @empty
                 No posts found!
            @endforelse
           
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
    
@endsection