<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResearchFormRequest;
use App\Models\Researchpage;
use Intervention\Image\Facades\Image;

class ResearchController extends Controller
{
    public function index()
    {
        $areas = Researchpage::all();
        return view('admin.pages.research.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.pages.research.create');
    }

    public function store(ResearchFormRequest $request)
    {
        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $item_type = $data['item_type'];
        $meta_title = $data['meta_title'];
        if ($request->hasfile('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = 'assets/images/research/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
        }
        $area = new Researchpage;
        $area->title = $title;
        $area->description = $description;
        $area->item_type = $item_type;
        $area->cover_photo = $filepath;
        $area->meta_title = $meta_title;
        if ($request->has('meta_description')) {
            $area->meta_description = $data['meta_description'];
        }
        $area->save();

        return redirect('admin/pages/research-areas')->with('message', 'Research Area Added Successfully');
    }

    public function edit($area_id)
    {
        $area = Researchpage::find($area_id);
        return view('admin.pages.research.edit', compact('area'));
    }

    public function update(ResearchFormRequest $request, $area_id)
    {
        $data = $request->validated();
        $area = Researchpage::find($area_id);

        if ($request->hasfile('cover_photo')) {
            $oldImagePath = public_path($area->cover_photo);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $file = $request->file('cover_photo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = 'assets/images/research/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $area->cover_photo = $filepath;
        }
        $area->title = $data['title'];
        $area->description = $data['description'];
        $area->item_type = $data['item_type'];
        $area->meta_title = $data['meta_title'];
        $area->meta_description = $data['meta_description'];

        $area->update();

        return redirect('admin/pages/research-areas')->with('message', 'Research Area Updated Successfully');
    }

    public function destroy($area_id)
    {
        $area = Researchpage::find($area_id);
        if ($area) {
            $oldImagePath = public_path($area->cover_photo);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $area->delete();
            return redirect('admin/pages/research-areas')->with('message', 'Research Area Deleted Successfully');
        } else {
            return redirect('admin/pages/research-areas')->with('message', 'No Research Area Id Found');
        }
    }
}
