<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlumniFormRequest;
use App\Models\Alumni;
use Intervention\Image\Facades\Image;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::all();
        return view('admin.group.members.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.group.members.alumni.create');
    }

    public function store(AlumniFormRequest $request)
    {
        $data = $request->all();
        $name = $data['name'];
        $type = $data['type'];
        $title = $data['title'];
        $email = $data['email'];
        $google_scholar = $data['google_scholar'];
        $website = $data['website'];
        $current_position = $data['current_position'];
        $member = new Alumni;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = 'assets/images/members/alumni/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $member->image = $filepath;
        }
        $member->name = $name;
        $member->type = $type;
        $member->title = $title;
        $member->email = $email;
        $member->google_scholar = $google_scholar;
        $member->website = $website;
        $member->current_position = $current_position;
        $member->save();

        return redirect('admin/group/members/alumni')->with('message', 'New Alumni Member Added Successfully');
    }

    public function edit($alumni_id)
    {
        $alumni = Alumni::find($alumni_id);
        return view('admin.group.members.alumni.edit', compact('alumni'));
    }

    public function update(AlumniFormRequest $request, $alumni_id)
    {
        $data = $request->validated();
        $alumni = Alumni::find($alumni_id);

        if ($request->hasfile('image')) {
            if ($alumni->image && file_exists(public_path($alumni->image))) {
                unlink(public_path($alumni->image));
            }
            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = 'assets/images/members/alumni/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $alumni->image = $filepath;
        }
        $alumni->name = $data['name'];
        $alumni->type = $data['type'];
        $alumni->title = $data['title'];
        $alumni->email = $data['email'];
        $alumni->google_scholar = $data['google_scholar'];
        $alumni->website = $data['website'];
        $alumni->current_position = $data['current_position'];

        $alumni->update();

        return redirect('admin/group/members/alumni')->with('message', 'Alumni Member Updated Successfully');
    }

    public function destroy($alumni_id)
    {
        $alumni = Alumni::find($alumni_id);
        if ($alumni) {
            if ($alumni->image && file_exists(public_path($alumni->image))) {
                unlink(public_path($alumni->image));
            }
            $alumni->delete();
            return redirect('admin/group/members/alumni')->with('message', 'Alumni Member Deleted Successfully');
        } else {
            return redirect('admin/group/members/alumni')->with('message', 'Alumni Member Id Not Found');
        }
    }
}
