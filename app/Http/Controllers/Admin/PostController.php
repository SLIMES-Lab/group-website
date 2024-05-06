<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostFormRequest $request)
    {
        // dd($request->all());
        $data = $request->all();
        $description = $data['description'];
        $randomFolder = Str::random(15);
        $dom = new \DOMDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $imgData = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/assets/images/posts/" . $randomFolder . '/description/' . time() . $key . '.webp';
            $image_path = public_path() . $image_name;
            $directory = dirname($image_path);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            Image::make($imgData)->save($image_path, 60, 'webp');

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        $description = $dom->saveHTML();

        $post = new Post;
        $post->title = $data['title'];
        $post->subtitle = $data['subtitle'];
        $post->slug = Str::slug($data['title']);
        $post->description = $description;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = public_path('assets/images/posts/' . $randomFolder);
            if (!is_dir($filepath)) {
                mkdir($filepath, 0755, true);
            }
            $filepath = $filepath . '/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $post->image = 'assets/images/posts/' . $randomFolder . '/' . $filename;
        }
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $formattedDate = Carbon::parse($data['publish_date'])->format('Y-m-d');
        $post->publish_date = $formattedDate;

        $action = $request->input('action');
        if ($action === 'save_draft') {
            $post->is_draft = true;
        } else {
            $post->is_draft = false;
        }
        if ($request->input('anonymous')) {
            $post->user_id = null; // 0 represents an anonymous user
        } else {
            $post->user_id = auth()->id();
        }
        $post->save();

        $allCategoryIds = [];
        $allCategoryNames = $request->tags;
        foreach ($allCategoryNames as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $allCategoryIds[] = $category->id;
        }
        $post->categories()->attach($allCategoryIds);

        return redirect('admin/posts')->with('message', 'New Post Added Successfully');
    }

    public function edit($post_id)
    {
        $post = Post::find($post_id);
        $categories = Category::all();
        $post_ids = $post->categories->pluck('id');
        $selected_post_ids = $post_ids->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'selected_post_ids'));
    }

    public function update(PostFormRequest $request, $post_id)
    {
        $data = $request->validated();

        $post = Post::find($post_id);
        $oldImagePath = $post->image;
        $oldImageFolder = dirname($oldImagePath);

        $description = $data['description'];
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                $imgData = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = '/' . $oldImageFolder . '/description/' . time() . $key . '.webp';
                Image::make($imgData)->save(public_path() . $image_name, 60, 'webp');

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }
        $description = $dom->saveHTML();

        $post->title = $data['title'];
        $post->subtitle = $data['subtitle'];
        $post->slug = Str::slug($data['title']);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = $oldImageFolder . '/' . $filename;
            Image::make($file)->save($filepath, 60, 'webp');
            $post->image = $filepath;
        }
        $allCategoryIds = [];
        $allCategoryNames = $request->tags;

        foreach ($allCategoryNames as $categoryName) {
            // If the category name is numeric, it could be an ID of an existing category
            if (is_numeric($categoryName)) {
                // Check if a category with this ID exists
                $category = Category::find($categoryName);
                if ($category) {
                    // If it exists, add the ID to the array
                    $allCategoryIds[] = $categoryName;
                } else {
                    // If it doesn't exist, treat it as a new category name
                    $category = Category::firstOrCreate(['name' => $categoryName]);
                    $allCategoryIds[] = $category->id;
                }
            } else {
                // If it's not numeric, it's a name of a new category
                $category = Category::firstOrCreate(['name' => $categoryName]);
                $allCategoryIds[] = $category->id;
            }
        }

        $post->categories()->sync($allCategoryIds);

        $post->description = $description;
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $formattedDate = Carbon::parse($data['publish_date'])->format('Y-m-d');
        $post->publish_date = $formattedDate;
        if ($request->has('anonymous')) {
            $post->user_id = null;
        } else {
            $post->user_id = auth()->id();
        }
        $action = $request->input('action');
        if ($action === 'save_draft') {
            $post->is_draft = true;
        } else {
            $post->is_draft = false;
        }

        $post->update();

        return redirect('admin/posts')->with('message', 'Post Updated Successfully');
    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        if ($post) {
            $oldImagePath = $post->image;
            $oldImageFolder = dirname($oldImagePath);
            $oldDirectory = public_path($oldImageFolder);
            if (is_dir($oldDirectory)) {
                File::deleteDirectory($oldDirectory);
            }
            $post->delete();
            return redirect('admin/posts')->with('message', 'Post Deleted Successfully');
        } else {
            return redirect('admin/posts')->with('message', 'No Post Id Found');
        }
    }
}
