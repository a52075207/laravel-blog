<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Posts;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Posts $posts)
    {
        $posts = $posts->all();

        // $posts = (new \App\Repositories\Posts)->all();


        // $posts = Post::latest()
        //     ->filter(request(['month', 'year']))
        //     ->get();

        // $posts = Post::latest();

        // if ($month = request('month'))
        // {
        //     $posts->whereMonth('created_at', Carbon::parse($month)->month); // March -> 3, April -> 4
        // }

        // if ($year = request('year'))
        // {
        //     $posts->whereYear('created_at', $year);
        // }

        // $posts = $posts->get();

        $archives = Post::archives();

        return view('posts.index', compact('posts', 'archives'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {

        $this->validate(request(), [
            'title' => 'required',
            'body'  => 'required'
        ]);
        // $post = new Post;
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->save();

        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

        // Post::create([
        //     'title'   => request('title'),
        //     'body'    => request('body'),
        //     'user_id' => auth()->id()
        // ]);

        return redirect('/posts');
    }
}
