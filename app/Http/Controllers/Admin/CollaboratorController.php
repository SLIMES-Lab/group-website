<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CollaboratorFormRequest;
use App\Models\Collaborator;
use Intervention\Image\Facades\Image;

class CollaboratorController extends Controller
{
    public function index()
    {
        $collaborators = Collaborator::all();
        return view('admin.group.members.collaborators.index', compact('collaborators'));
    }

    public function create()
    {
        return view('admin.group.members.collaborators.create');
    }

    public function store(CollaboratorFormRequest $request)
    {
        $data = $request->all();
        $name = $data['name'];
        $total_projects = $data['total_projects'];
        $email = $data['email'];
        $google_scholar = $data['google_scholar'];
        $website = $data['website'];
        $current_position = $data['current_position'];
        $member = new Collaborator;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = 'assets/images/members/collaborators/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $member->image = $filepath;
        }
        $member->name = $name;
        $member->total_projects = $total_projects;
        $member->email = $email;
        $member->google_scholar = $google_scholar;
        $member->website = $website;
        $member->current_position = $current_position;
        $member->save();

        return redirect('admin/group/members/collaborators')->with('message', 'New Collaborator Added Successfully');
    }

    public function edit($collaborator_id)
    {
        $collaborator = Collaborator::find($collaborator_id);
        return view('admin.group.members.collaborators.edit', compact('collaborator'));
    }

    public function update(CollaboratorFormRequest $request, $collaborator_id)
    {
        $data = $request->validated();
        $collaborator = Collaborator::find($collaborator_id);

        if ($request->hasfile('image')) {
            if ($collaborator->image && file_exists(public_path($collaborator->image))) {
                unlink(public_path($collaborator->image));
            }
            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = 'assets/images/members/collaborators/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $collaborator->image = $filepath;
        }
        $collaborator->name = $data['name'];
        $collaborator->total_projects = $data['total_projects'];
        $collaborator->email = $data['email'];
        $collaborator->google_scholar = $data['google_scholar'];
        $collaborator->website = $data['website'];
        if (isset($request['current_position'])) {
            $collaborator->current_position = $data['current_position'];
        }

        $collaborator->update();

        return redirect('admin/group/members/collaborators')->with('message', 'Collaborator Updated Successfully');
    }

    public function destroy($collaborator_id)
    {
        $collaborator = Collaborator::find($collaborator_id);
        if ($collaborator) {
            if ($collaborator->image && file_exists(public_path($collaborator->image))) {
                unlink(public_path($collaborator->image));
            }
            $collaborator->delete();
            return redirect('admin/group/members/collaborators')->with('message', 'Collaborator Deleted Successfully');
        } else {
            return redirect('admin/group/members/collaborators')->with('message', 'Collaborator Id Not Found');
        }
    }
}
