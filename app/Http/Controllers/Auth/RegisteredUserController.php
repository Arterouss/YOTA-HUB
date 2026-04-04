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
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
        // 1. Validasi Ketat
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'], // Aspek Hukum YOTA HUB
        ]);

        // 2. Pembuatan User dengan UUID dan Metadata Enterprise
        $user = User::create([
            'id' => (string) Str::uuid(), // Mengisi Primary Key UUID
            'uuid' => (string) Str::uuid(), // Kolom uuid tambahan jika masih digunakan
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // Konsep Dasar Platform YOTA HUB
            'level' => 1, // Layer 1 (Open Learning)
            'member_type' => 'basic',
            'agreed_to_terms' => true,
            'terms_agreed_at' => Carbon::now(),
            'registration_ip' => $request->ip(),
        ]);

        // 3. INTEGRASI ROLE: Memberikan akses dasar secara otomatis
        $user->assignRole('basic_member');

        event(new Registered($user));

        Auth::login($user);

        // Redirect ke dashboard (Layer 1 - Open Learning)
        return redirect(route('dashboard', absolute: false));
    }
}
