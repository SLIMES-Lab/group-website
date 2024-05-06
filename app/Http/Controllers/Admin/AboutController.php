<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutFormRequest;
use App\Models\Aboutpage;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function index($id)
    {
        $about = Aboutpage::find(1);
        return view('admin.pages.about', compact('about'));
    }

    public function update(AboutFormRequest $request)
    {
        $data = $request->validated();

        $about = Aboutpage::find(1);
        $about->description = $data['description'];

        if ($request->hasfile('group_photo')) {
            $oldImagePath = public_path('assets/images/about/' . $about->group_photo);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $file = $request->file('group_photo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = public_path('assets/images/about/') . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $about->group_photo = $filename;
        }

        $about->update();

        return redirect('admin/pages/about/1')->with('message', 'About data updated successfully');
    }
}
