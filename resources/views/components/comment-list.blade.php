@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-tags :tags="$comment->tags" />
    <x-updated :date="$comment->created_at->diffForHumans()" :name="$comment->user->name" />
@empty
    <p>No comments yet!</p>
@endforelse