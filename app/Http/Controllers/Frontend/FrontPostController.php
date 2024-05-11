<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        $categories = Category::all();
        return view('frontend.blogs.index', compact('posts', 'categories'));
    }
    public function showSinglePost($post_id)
    {
        $post = Post::find($post_id);
        $recent_posts = Post::where('id', '!=', $post_id)->orderBy('created_at', 'desc')->take(3)->get();
        $categories = Category::all();
        $post_ids = $post->categories->pluck('id');
        $selected_post_ids = $post_ids->toArray();
        $matching_categories = Category::whereIn('id', $selected_post_ids)->get();
        return view('frontend.blogs.single-post', compact('post', 'recent_posts', 'categories', 'matching_categories'));
    }
    public function search(Request $request)
    {
        $query = $request->query('query');
        $results = Post::where('title', 'like', "%{$query}%")->get();
        $categories = Category::all();
        return view('frontend.blogs.search', compact('results', 'categories', 'query'));
    }

    public function showPostsByCategory($category_id)
    {
        $posts = Category::find($category_id)->posts;
        $category = Category::find($category_id);
        $other_categories = Category::where('id', '!=', $category_id)->get();
        return view('frontend.blogs.category-posts', compact('posts', 'category', 'other_categories'));
    }
}
