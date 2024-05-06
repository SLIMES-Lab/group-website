<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumFormRequest;
use App\Models\Album;
use App\Models\AlbumImages;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return view('admin.gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(AlbumFormRequest $request)
    {
        $album = Album::create($request->all());
        $randomFolder = Str::random(15);
        foreach ($request->images as $image) {
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = 'assets/images/albums/' . $randomFolder . '/' . $filename;
            $directory = 'assets/images/albums/' . $randomFolder;
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            Image::make($image)->save($filepath, 60, 'webp');
            AlbumImages::create([
                'album_id' => $album->id,
                'path' => $filepath
            ]);
        }
        return redirect('admin/group/all-album')->with('message', 'Album Added Successfully');
    }

    public function viewAlbum($album_id)
    {
        $album = Album::findOrFail($album_id);
        $allImages = $album->images;
        return view('admin.gallery.view', compact('album', 'allImages'));
    }

    public function edit($album_id)
    {
        $album = Album::findOrFail($album_id);
        $allImages = $album->images;
        return view('admin.gallery.edit', compact('album', 'allImages'));
    }

    public function deleteSingleImage($image_id)
    {
        $albumImage = AlbumImages::find($image_id);
        if ($albumImage) {
            $destination = $albumImage->path;
            if (file_exists(public_path($destination))) {
                unlink(public_path($destination));
                $albumImage->delete();
            }
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

    }

    public function update(AlbumFormRequest $request, $album_id)
    {
        $data = $request->all();

        $album = Album::find($album_id);
        $allImages = $album->images;
        $oldImagePath = $allImages[0]->path;
        $oldImageFolder = dirname($oldImagePath);
        $album->year = $data['year'];

        if (isset($request->images)) {
            foreach ($request->images as $image) {
                $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '_' . time()
                    . '.webp';
                $filepath = $oldImageFolder . '/' . $filename;
                Image::make($image)->save($filepath, 60, 'webp');
                AlbumImages::create([
                    'album_id' => $album->id,
                    'path' => $filepath
                ]);
            }
        }

        $album->update();

        return redirect('admin/group/all-album')->with('message', 'Album Updated Successfully');
    }

    public function destroy($album_id)
    {
        $album = Album::find($album_id);
        if ($album) {
            $allImages = $album->images;
            $oldImagePath = $allImages[0]->path;
            $oldImageFolder = dirname($oldImagePath);
            \File::deleteDirectory($oldImageFolder);
            foreach ($allImages as $image) {
                $image->delete();
            }
            $album->delete();
            return redirect('admin/group/all-album')->with('message', 'Album Deleted Successfully');
        } else {
            return redirect('admin/group/all-album')->with('message', 'No Album Id Found');
        }
    }
}
