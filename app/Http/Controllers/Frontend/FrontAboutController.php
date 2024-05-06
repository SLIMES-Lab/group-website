<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Aboutpage;

class FrontAboutController extends Controller
{
    public function index()
    {
        $about = Aboutpage::find(1);
        return view('frontend.about', compact('about'));
    }
}
