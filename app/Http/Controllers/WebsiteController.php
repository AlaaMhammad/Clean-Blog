<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function index()
    {
        $posts =Post::with('category', 'author')->latest()->simplePaginate(4);
        return view('website.index', compact('posts'));
    }

    public function about()
    {
        return view('website.about');
    }

    public function contact()
    {
        return view('website.contact');
    }

    function contact_save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);
        Contact::create($request->except('_token'));
        flash()->success('Message sent successfully');
        return redirect()->back();
    }

    public function post(Post $post)
    {
        return view('website.post', compact('post'));
    }

    function category(Category $category)
    {
        $posts = $category->posts()->latest()->simplePaginate(4);
        return view('website.category', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    function author(User $user)
    {
        $posts = $user->posts()->latest()->simplePaginate(4);
        return view('website.author', [
            'author' => $user,
            'posts' => $posts,
        ]);
    }
}
