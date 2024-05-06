<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use App\Models\Post;

class FrontHomeController extends Controller
{
    public function index()
    {
        $homedata = Homepage::find(1);
        $posts = Post::where('is_draft', '!=', 1)
            ->where('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->take(3)
            ->get();
        return view('frontend.home', compact('homedata', 'posts'));
    }
}
