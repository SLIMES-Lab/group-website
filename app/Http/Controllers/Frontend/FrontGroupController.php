<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Collaborator;
use App\Models\User;
use App\Models\Alumni;

class FrontGroupController extends Controller
{
    public function showCurrentMembers()
    {
        $members = User::all();
        $currentMembers = $members->where('is_alumni', '!=', 1);
        return view('frontend.group.current-members', compact('currentMembers'));
    }
    public function showAlumni()
    {
        $alumniMembers = Alumni::orderBy('created_at', 'desc')->get();
        return view('frontend.group.alumni-members', compact('alumniMembers'));
    }

    public function showSingleUser($id)
    {
        $member = User::find($id);
        return view('frontend.group.single-member', compact('member'));
    }

    public function showSingleAlumni($id)
    {
        $member = Alumni::find($id);
        return view('frontend.group.single-member', compact('member'));
    }

    public function showCollaborators()
    {
        $collaborators = Collaborator::orderBy('name', 'asc')->get();
        return view('frontend.group.collaborators', compact('collaborators'));
    }

    public function showSingleCollaborator($id)
    {
        $member = Collaborator::find($id);
        return view('frontend.group.single-member', compact('member'));
    }

    public function showAllAlbums()
    {
        $albums = Album::all();
        return view('frontend.group.gallery', compact('albums'));
    }

    public function showSingleAlbum($id)
    {
        $album = Album::find($id);
        return view('frontend.group.single-album', compact('album'));
    }
}
