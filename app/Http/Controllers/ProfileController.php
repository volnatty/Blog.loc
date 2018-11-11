<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('app.profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        if ($request->hasFile('avatar')) {
            Storage::delete(str_replace('media/', '', Auth::user()->avatar));
            $path = $request->file('avatar')->store('profile');
            Auth::user()->update([
                'avatar' => 'media/' . $path,
            ]);
        }

        Auth::user()->update([
            'name' => $request->name,
        ]);

        return back();
    }
}
