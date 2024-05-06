<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Researchpage;
use Illuminate\Http\Request;

class FrontResearchController extends Controller
{
    public function index()
    {
        $research_areas = Researchpage::all();
        return view('frontend.research', compact('research_areas'));
    }
}
