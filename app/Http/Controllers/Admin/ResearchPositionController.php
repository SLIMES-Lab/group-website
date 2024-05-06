<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResearchPositionFormRequest;
use App\Models\ResearchPosition;
use Carbon\Carbon;

class ResearchPositionController extends Controller
{
    public function index()
    {
        $positions = ResearchPosition::all();
        return view('admin.group.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.group.positions.create');
    }

    public function store(ResearchPositionFormRequest $request)
    {
        $data = $request->all();
        $position = new ResearchPosition;
        $position->title = $data['title'];
        $position->description = $data['description'];
        $position->requirements = $data['requirements'];
        $position->location = $data['location'];
        $position->duration = $data['duration'];
        $position->start_date = $data['start_date'];
        $formattedDate = Carbon::parse($data['application_deadline'])->format('Y-m-d');
        $position->application_deadline = $formattedDate;
        $position->how_to_apply = $data['how_to_apply'];
        $position->contact_information = $data['contact_information'];
        $position->funding = $data['funding'];
        $position->save();

        return redirect('admin/group/positions')->with('message', 'New Research Position Added Successfully');
    }

    public function edit($position_id)
    {
        $position = ResearchPosition::find($position_id);
        return view('admin.group.positions.edit', compact('position'));
    }

    public function update(ResearchPositionFormRequest $request, $position_id)
    {
        $data = $request->validated();
        $position = ResearchPosition::find($position_id);
        $position->title = $data['title'];
        $position->description = $data['description'];
        $position->requirements = $data['requirements'];
        $position->location = $data['location'];
        $position->duration = $data['duration'];
        $position->start_date = $data['start_date'];
        $formattedDate = Carbon::parse($data['application_deadline'])->format('Y-m-d');
        $position->application_deadline = $formattedDate;
        $position->how_to_apply = $data['how_to_apply'];
        $position->contact_information = $data['contact_information'];
        $position->funding = $data['funding'];

        $position->update();

        return redirect('admin/group/positions')->with('message', 'Vacant Position Updated Successfully');
    }

    public function destroy($position_id)
    {
        $position = ResearchPosition::find($position_id);
        if ($position) {
            $position->delete();
            return redirect('admin/group/positions')->with('message', 'Vacant Position Deleted Successfully');
        } else {
            return redirect('admin/group/positions')->with('message', 'Vacant Position Id Not Found');
        }
    }
}
