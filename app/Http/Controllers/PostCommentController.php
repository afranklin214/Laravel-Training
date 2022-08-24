<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as EventsCommentPosted;
use App\Http\Requests\StoreComment;
use App\Mail\CommentPostedMarkdown;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);  
    }

    public function index(BlogPost $post)
    {
        return $post->comments;
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content'=> $request->input('content'),
            'user_id'=> $request->user()->id
        ]);

        // Mail::to($post->user)->send(
        //     new CommentPostedMarkdown($comment)
        // );

        // Mail::to($post->user)->queue(
        //     new CommentPostedMarkdown($comment)
        // );

        event(new EventsCommentPosted($comment));

       
        return redirect()->back()
            ->withStatus('Comment was created');
    }
}
