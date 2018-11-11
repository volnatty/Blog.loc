<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        if (!in_array(app('router')->currentRouteName(), ['app.posts.index', 'app.posts.show']) && !auth()->check()) {
            $this->middleware('auth');
        }
    }

    public function index()
    {
        $postlist = Post::query();

        if (request()->filled('tag')) {
            $postlist = $postlist->whereHas('tags', function ($q) {
                $q->where('tag_id', request('tag'));
            });
        }

        if (request()->filled('author')) {
            $postlist = $postlist->where('user_id', request()->author);
        }

        return view('app.posts.index', [
            'postlist' => $postlist->paginate(5),
        ]);
    }

    public function create()
    {
        return view('app.posts.create', [
            'categories' => Category::orderBy('title')->get(),
            'tags' => Tag::orderBy('title')->get(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::create(request()->all());

        $post->tags()->attach(request('tags'));


        return redirect()->route('app.posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('app.posts.show', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required',

        ]);
        $post->update(request()->all());
        $post->tags()->sync(request('tags'));

///////////////////////
        if ($request->hasFile('picture')) {
        Storage::set(str_replace('media/','',$post->picture));
        $path = $request->file('picture')->store('posts');
            $post->update([
                'picture' => 'media/' . $path,
            ]);
            $post->media()->update(request()->only(['mediable_type','mediable_id',]));
            $post->media()->create();
        }

/// ///////////

        return redirect()->route('app.posts.show', $post);

    }

    public function edit (Post $post)
    {
        return view('app.posts.edit', compact('post') , [
            'post' => Post::query(),
            'categories' => Category::orderBy('title')->get(),
            'tags' => Tag::orderBy('title')->get(),
        ]);
    }
    public function destroy(Post $post)
    {
        $this->checkUser($post);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('app.posts.index');
    }


    private function checkUser(Post $post) {
        if ($post->user_id !== auth()->user()->id) {
            return back();
        }
    }

    public function addComment(Request $request, Post $post)
    {
        $comment = $post->comments()->create([
            'message'=>$request->message,
            'user_id'=>$request->user_id,]);
        if (auth()->user()->id == $request->user_id) {
            $comment->update(['approved' => 1]);
        }
        return back();
    }

}
