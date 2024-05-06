<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    public function show($post_id)
    {
        $post = Post::find($post_id);
        $recent_posts = Post::where('id', '!=', $post_id)->orderBy('created_at', 'desc')->take(3)->get();
        return view('frontend.blogs.single-post', compact('post', 'recent_posts'));
    }
}
