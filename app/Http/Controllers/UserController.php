<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function showUsers()
    {

        $landowners = User::where('role', 'land_owner')->get();
        $tenants = User::where('role', 'tenant')->get();
        $lessees = User::where('role', 'lessee')->get();

        return view('users.superadmin.users', compact('landowners', 'tenants', 'lessees'));
    }

    /**
     * Update the user's profile information.
     */
}
