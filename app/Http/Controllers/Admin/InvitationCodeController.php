<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvitationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationCodeMailable;

class InvitationCodeController extends Controller
{
    public function create()
    {
        return view('admin.invitation-codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:invitation_codes,email'],
        ]);

        $code = Str::random(8);

        InvitationCode::create([
            'email' => $request->email,
            'code' => $code,
        ]);
        // dd($code);
        $mailData = [
            'email' => $request->email,
            'code' => $code,
        ];
        Mail::to($request->email)->send(new InvitationCodeMailable($mailData));

        return redirect()->route('admin.invitation-codes.create')->with('status', 'Invitation code created successfully.');
    }
}
