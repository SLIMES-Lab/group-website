<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeFormRequest;
use App\Models\Homepage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($id)
    {
        $home = Homepage::find(1);
        return view('admin.pages.home', compact('home'));
    }

    public function update(HomeFormRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();

        $home = Homepage::find(1);
        $home->heading = $data['heading'];
        $home->subheading = $data['subheading'];
        $home->topics = $data['topics'];
        $home->papers = $data['papers'];
        $home->citations = $data['citations'];
        $home->group_members = $data['group_members'];
        $home->john_details = $data['john_details'];

        if ($request->hasfile('homepage_image')) {
            $oldImagePath = public_path('assets/images/home/' . $home->homepage_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $file = $request->file('homepage_image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.' . $file->getClientOriginalExtension();
            $file->move('assets/images/home/', $filename);
            $home->homepage_image = $filename;
        }

        if ($request->hasfile('john_image')) {
            $oldImagePath = public_path('assets/images/home/' . $home->john_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $file = $request->file('john_image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.' . $file->getClientOriginalExtension();
            $file->move('assets/images/home/', $filename);
            $home->john_image = $filename;
        }

        $home->update();

        return redirect('admin/pages/home/1')->with('message', 'Home data updated successfully');
    }
}
