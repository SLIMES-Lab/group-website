<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Hobby;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load('hobbies');
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . time()
                . '.webp';
            $filepath = '/assets/images/members/current/' . $filename;
            if ($user->photo) {
                $oldPhotoPath = public_path() . $user->photo;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            Image::make($file)->save(public_path() . $filepath, 60, 'webp');
            $user->photo = $filepath;
        }
        $user->type = $data['type'] ?? null;
        $user->position = $data['position'] ?? null;
        $user->research_title = $data['research_title'] ?? null;
        $user->starting_year = $data['starting_year'] ?? null;
        $user->biography = $data['biography'];
        $user->website = $data['website'];
        $user->linkedin = $data['linkedin'];
        $user->google_scholar = $data['google_scholar'];
        $user->researchgate = $data['researchgate'];
        $user->github = $data['github'];

        $allHobbyIds = [];
        $allHobbyNames = $request->hobbies;

        foreach ($allHobbyNames as $hobbyName) {
            $hobby = Hobby::firstWhere('hobby', $hobbyName);
            if (!$hobby) {
                $hobby = Hobby::firstOrCreate(['hobby' => $hobbyName]);
            }
            $allHobbyIds[] = $hobby->id;
        }
        $user->hobbies()->sync($allHobbyIds);


        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
