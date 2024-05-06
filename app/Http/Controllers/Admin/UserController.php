<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUser;

class UserController extends Controller
{
    public function index()
    {
        $currentMembers = User::all();
        return view('admin.group.members.current', compact('currentMembers'));
    }
    public function addUser()
    {
        return view('admin.addUser.create');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Set a random password that the user won't know
            'password' => bcrypt(Str::random(16)),
        ]);

        // Generate a password reset token
        $token = app('auth.password.broker')->createToken($user);

        // Send the password reset email
        Password::sendResetLink([
            'email' => $user->email,
            'token' => $token,
        ]);

        return redirect()->back()->with('status', 'User added successfully!');
    }
    public function destroy($user_id)
    {
        $member = User::find($user_id);
        if ($member) {
            $member->delete();
            return redirect('admin/group/members/current')->with('message', 'Member Deleted Successfully');
        } else {
            return redirect('admin/group/members/current')->with('message', 'No Member Id Found');
        }
    }

    public function make_alumni($user_id)
    {
        $member = User::find($user_id);
        if ($member) {
            $member->is_alumni = 1;
            $member->save();
            # create an entry in the alumni table
            $alumni = new Alumni;
            $alumni->id = $member->id;
            $alumni->name = $member->name;
            if ($member->type) {
                $alumni->type = $member->type;
            } else {
                $alumni->type = "Will Be Updated Soon";
            }
            if ($member->research_title) {
                $alumni->title = $member->research_title;
            } else {
                $alumni->title = "Will Be Updated Soon";
            }
            $alumni->email = $member->email;
            $alumni->google_scholar = $member->google_scholar;
            $alumni->website = $member->website;
            $alumni->image = $member->photo;
            $alumni->save();

            return redirect('admin/group/members/current')->with('message', 'Member is now an alumni. You should update all details in the "Alumni" section.');
        } else {
            return redirect('admin/group/members/current')->with('message', 'No Member Id Found');
        }
    }
    public function make_current($user_id)
    {
        $member = User::find($user_id);
        if ($member) {
            $member->is_alumni = 0;
            $member->save();
            # delete the entry from the alumni table
            $alumni = Alumni::find($user_id);
            if ($alumni) {
                $alumni->delete();
            }
            return redirect('admin/group/members/current')->with('message', 'Member is now an current member.');
        } else {
            return redirect('admin/group/members/current')->with('message', 'No Member Id Found');
        }
    }

    public function add_admin($user_id)
    {
        $member = User::find($user_id);
        if ($member) {
            $member->is_admin = 1;
            $member->save();
            return redirect('admin/group/members/current')->with('message', 'Member is now an admin. He/She can now manage the group.');
        } else {
            return redirect('admin/group/members/current')->with('message', 'No Member Id Found');
        }
    }
    public function remove_admin($user_id)
    {
        $member = User::find($user_id);
        if ($member) {
            $member->is_admin = 0;
            $member->save();
            return redirect('admin/group/members/current')->with('message', 'Admin rights removed successfully.');
        } else {
            return redirect('admin/group/members/current')->with('message', 'No Member Id Found');
        }
    }
}
