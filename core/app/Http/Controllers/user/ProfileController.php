<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ===============================
    // Profile View
    // ===============================
    public function index()
    {
        $profile = Profile::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'division' => '',
            ]
        );

        return view('frontend.profile.index', compact('profile'));
    }

    // Profile edit
    public function edit()
    {
        $profile = Profile::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'division' => '',
            ]
        );

        return view('frontend.profile.edit', compact('profile'));
    }

    // ===============================
    // Update Profile
    // ===============================
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'blood' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'number' => 'required|string|max:20',
            'division' => 'required|in:Dhaka,Chattogram,Khulna,Rajshahi,Barishal,Sylhet,Rangpur,Mymensingh',
            'last_donated' => 'nullable|date',
        ]);

        $profile = Profile::where('user_id', Auth::id())->firstOrFail();

        $profile->update([
            'name' => $request->name,
            'blood' => $request->blood,
            'number' => $request->number,
            'division' => $request->division,   
            'last_donated' => $request->last_donated,
        ]);

        return redirect('/profile')
            ->with('success', 'Profile updated successfully.');
    }
}