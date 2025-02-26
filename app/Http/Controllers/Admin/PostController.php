<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author', 'category')->latest()->get();

        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        return view('dashboard.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        // upload image using cuustom filesystem
        $path = $request->file('image')->store('uploads', 'custom');
        $data['image'] = $path;
        // $data['author_id'] = Auth::id();
        $data['author_id'] = 1;

        $post = Post::create($data);

        $post->tags()->attach($request->tags);

        flash()->success('Post added successfully');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('dashboard.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();

        // upload image using cuustom filesystem
        if ($request->hasFile('image')) {
            File::delete($post->image);
            $path = $request->file('image')->store('uploads', 'custom');
            $data['image'] = $path;
        }
        // $data['author_id'] = Auth::id();
        $data['author_id'] = 1;

        Post::update($data);

        $post->tags()->sync($request->tags);

        flash()->success('Post updated successfully');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        File::delete($post->image);
        $post->delete();

        flash()->success('Post deleted successfully');
        return redirect()->route('admin.posts.index');
    }
}
