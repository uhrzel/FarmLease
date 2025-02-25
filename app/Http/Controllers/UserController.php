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

    public function userReport()
    {
        $totalUsers = User::where('role', '!=', 'superadmin')->count();

        $roles = User::selectRaw('role, COUNT(*) as count')
            ->where('role', '!=', 'superadmin')
            ->groupBy('role')
            ->get();

        $data = $roles->map(function ($role) use ($totalUsers) {
            return [
                'role' => $role->role,
                'count' => $role->count,
                'percentage' => round(($role->count / max($totalUsers, 1)) * 100, 2),
            ];
        });

        return view('users.superadmin.generate_form', compact('data'));
    }


    /**
     * Update the user's profile information.
     */
}
