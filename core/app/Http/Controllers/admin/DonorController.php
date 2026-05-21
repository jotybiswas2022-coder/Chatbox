<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class DonorController extends Controller
{
    // ==============================
    // Donor List
    // ==============================
    public function index(Request $request){
        $query = Profile::query();

        if ($request->filled('search_name')) {
            $query->where('name', 'like', '%' . $request->search_name . '%');
        }

        if ($request->filled('search_division')) {
            $query->where('division', $request->search_division);
        }

        // Pagination (10 per page)
        $donors = $query->orderBy('id','desc')->paginate(10);
        $donorsCount = Profile::count(); 
        
        return view('backend.donor_list.index', compact('donors', 'donorsCount'));
    }
    // ==============================
    // Show Create Donor Page
    // ==============================
    public function create()
    {
        $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];

        $divisions = [
            'Dhaka',
            'Chattogram',
            'Khulna',
            'Rajshahi',
            'Barishal',
            'Sylhet',
            'Rangpur',
            'Mymensingh'
        ];

        return view('backend.donor_list.create', compact('groups','divisions'));
    }

    // ==============================
    // Store New Donor
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'number'        => 'required|string|max:20',
            'blood'         => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'division'      => 'required|in:Dhaka,Chattogram,Khulna,Rajshahi,Barishal,Sylhet,Rangpur,Mymensingh',
            'last_donated'  => 'nullable|date',
        ]);

        Profile::create([
            'name'         => $request->name,
            'number'       => $request->number,
            'blood'        => $request->blood,
            'division'     => $request->division,   
            'last_donated' => $request->last_donated,
            'user_id'      => null,
        ]);

        return redirect()->route('donor.index')
            ->with('success', 'Donor added successfully.');
    }

    // ==============================
    // Get Single Donor
    // ==============================
    public function edit($id)
    {
        $donor = Profile::findOrFail($id);
        return response()->json($donor);
    }

    // ==============================
    // Update Donor
    // ==============================
    public function update(Request $request, $id)
    {
        $donor = Profile::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'number'        => 'required|string|max:20',
            'blood'         => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'division'      => 'required|in:Dhaka,Chattogram,Khulna,Rajshahi,Barishal,Sylhet,Rangpur,Mymensingh',
            'last_donated'  => 'nullable|date',
        ]);

        $donor->update($request->only([
            'name',
            'number',
            'blood',
            'division',   
            'last_donated'
        ]));

        return back()->with('success', 'Donor updated successfully.');
    }

    // ==============================
    // Delete Donor
    // ==============================
    public function delete($id)
    {
        $donor = Profile::findOrFail($id);
        $donor->delete();

        return back()->with('success', 'Donor deleted successfully.');
    }
}