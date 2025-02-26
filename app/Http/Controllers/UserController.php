<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NotificationMail;
use Illuminate\Http\Request;

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

    public function getTenants()
    {
        $tenants = User::where('role', 'tenant')->get();
        return view('users.superadmin.mail_notification', compact('tenants'));
    }
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            Mail::to($request->email)->send(new NotificationMail($request->subject, $request->message));
            return response()->json(['status' => 'success', 'message' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to send email.']);
        }
    }
}
