<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function home()
    {
        return view('web.home', [
            'posts' => Post::publish()->latest()->take(2)->get(),
            'postsWidget' => Post::publish()->latest()->take(7)->get(),
            'postsFootbar' => Post::publish()->latest()->take(3)->get(),
            'categories' => Category::all()
        ]);
    }

    public function blog()
    {
        return view('web.blog', [
            'allPosts' => Post::publish()->latest()->get(),
            'categories' => Category::all(),
            'postsFootbar' => Post::publish()->latest()->take(3)->get(),
        ]);
    }

    public function contact()
    {
        return view('web.contact', [
            'categories' => Category::all(),
            'postsFootbar' => Post::publish()->latest()->take(3)->get(),
        ]);
    }

    public function about()
    {
        return view('web.about', [
            'categories' => Category::all(),
            'postsFootbar' => Post::publish()->latest()->take(3)->get(),
        ]);
    }

    public function showDetailPost($slug)
    {
        $post = Post::publish()->where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('blog.home');
        }
        // dd($post);
        return view(
            'web.post_detail',
            [
                'categories' => Category::all(),
                'postsFootbar' => Post::publish()->latest()->take(3)->get(),
                'post' => $post
            ]
        );
    }

    public function showPostsByCategory($slug)
    {

        $posts = Post::publish()->whereHas('categories', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->get();

        $category = Category::where('slug', $slug)->first();

        return view('web.posts_category', [
            'posts' => $posts,
            'category' => $category,
            'categories' => Category::all(),
            'postsFootbar' => Post::publish()->latest()->take(3)->get(),
        ]);
    }
}
