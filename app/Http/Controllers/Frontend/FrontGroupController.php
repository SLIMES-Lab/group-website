<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FrontGroupController extends Controller
{
    public function showCurrentMembers()
    {
        $currentMembers = User::all();
        return view('frontend.group.current-members', compact('currentMembers'));
    }
}
