<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:registrations,email',
            'password' => 'required|confirmed|min:6',
        ]);

        Registration::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/sign-in')->with('success', 'User registered successfully!');
    }
}
