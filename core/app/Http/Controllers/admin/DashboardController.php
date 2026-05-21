<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function index(){
        // Fetch counts
        $accountsCount = Account::count();
        $contactsCount = Contact::count();
        $donorsCount = Profile::count(); 

        // Fetch recent data
        $contacts = Contact::latest()->take(5)->get(); 
        $donors = Profile::latest()->take(10)->get(); // Recent 10 donors
        $account = Account::first(); // Admin account info

        // Pass donorsCount to the view
        return view('backend.index', compact(
            'accountsCount',
            'contacts',
            'contactsCount',
            'donors',
            'account',
            'donorsCount' 
        ));
    }
}