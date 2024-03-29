<?php

namespace App\Http\Controllers;


use App\Events\BlogPosted;
use App\Facades\CounterFacade;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);

    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view(
            'posts.index', 
            [
                'posts' => BlogPost::latestWithRelations()->get(),
                
            ]

        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validated);

        if ($request->hasFile('thumbnail')) {
            $imageName =  $blogPost->id . '.'.  $request->file('thumbnail')->guessExtension();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $imageName);
            $blogPost->image()->save(
                Image::make(['path' => $path])
            );
        }

        event(new BlogPosted($blogPost));
    

        $request->session()->flash('status', 'The blog post was created!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);
        
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use($id) {
            return BlogPost::with('comments', 'tags', 'user', 'comments.user')
                ->findOrFail($id);
        });

        return view('posts.show', [
            'post' => $blogPost,
            'counter' => CounterFacade::increment("blog-post-{$id}", ['blog-post']),
        ]);

            // return view('posts.show', [
            //     'post' => BlogPost::with(['comments' => function ($query) {
            //         return $query->latest();
            //     }])->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, "You do not have permission to edit this Blog Post");
        // }

        $this->authorize($post);

        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize($post);

        $validated = $request->validated();
        $post->fill($validated);

        if ($request->hasFile('thumbnail')) {
            $imageName =  $post->id . '.'.  $request->file('thumbnail')->guessExtension();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $imageName);

            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }
           
        }

        $post->save();

        $request->session()->flash('status', 'Blog post was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        $post->delete();

        session()->flash('status', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }
}
