<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index(){

        $posts = Post::with('user')->latest()->get(); // eager loading posts with its user


        return inertia()->render('Posts/Index', [
            'posts' => PostResource::collection($posts),
            'now' => now(),
            'can' => [
                'post_create' => auth()->user()->can('create', Post::class),
            ]
        ]);
    }

    public function store(StorePostRequest $request){

        abort(403);

//sleep(5)
        auth()->user()->post()->create($request->validated());
        return redirect()->route('posts.index')->with('success','Post Created Succesfully');
    }
}
