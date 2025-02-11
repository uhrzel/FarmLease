<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'middlename' => ['nullable', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'string', 'max:15'],
                'city' => ['required', 'string', 'max:255'],
                'barangay' => ['required', 'string', 'max:255'],
                'street_address' => ['required', 'string', 'max:255'],
                'zipcode' => ['required', 'string', 'max:10'],
                'valid_id' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                'identity_recognition' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Handle file uploads
            $validIdPath = $request->file('valid_id')->store('valid_ids', 'public');
            $identityRecognitionPath = null;

            if ($request->hasFile('identity_recognition')) {
                $identityRecognitionPath = $request->file('identity_recognition')->store('identity_recognition', 'public');
            }

            $user = User::create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'barangay' => $request->baranggay,
                'street_address' => $request->street_address,
                'zipcode' => $request->zipcode,
                'valid_id' => $validIdPath,
                'identity_recognition' => $identityRecognitionPath,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong during registration. Please try again.']);
        }
    }
}
