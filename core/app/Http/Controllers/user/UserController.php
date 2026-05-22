<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class UserController extends Controller
{
     public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Message sent successfully!');
    }

    public function search(Request $request)
    {
        $query = trim($request->get('query', ''));

        $users = User::where('id', '!=', auth()->id())
            ->when($query !== '', function ($queryBuilder) use ($query) {
                $queryBuilder->where(function ($inner) use ($query) {
                    $inner->where('email', 'LIKE', "%{$query}%")
                          ->orWhere('name', 'LIKE', "%{$query}%");

                    if (is_numeric($query)) {
                        $inner->orWhere('id', $query);
                    }
                });
            })
            ->select('id', 'name', 'email')
            ->limit(10)
            ->get();

        return response()->json($users);
    }
}
