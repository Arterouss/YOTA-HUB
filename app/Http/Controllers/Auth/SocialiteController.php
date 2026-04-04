<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        // 3/31/2026 Edit Bayu - Mematikan verifikasi SSL menggunakan Guzzle dan menambah mode stateless agar tidak error cURL 60 di environment lokal.
        $httpClient = new \GuzzleHttp\Client(['verify' => false]);
        return Socialite::driver('google')
            ->setHttpClient($httpClient)
            ->stateless()
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // 3/31/2026 Edit Bayu - Mematikan verifikasi SSL (Guzzle) dan set stateless agar terhindar dari cURL Error 60 dan InvalidStateException saat callback.
            $httpClient = new \GuzzleHttp\Client(['verify' => false]);
            $googleUser = Socialite::driver('google')
                ->setHttpClient($httpClient)
                ->stateless()
                ->user();

            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if ($user) {
                // Update data Google jika user sudah ada
                $updateData = [
                    'google_id' => $googleUser->id,
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                ];
                // 3/31/2026 Edit Bayu - Otomatis verifikasi email kalau dari Google
                if (!$user->hasVerifiedEmail()) {
                    $updateData['email_verified_at'] = now();
                }
                $user->update($updateData);
            } else {
                // Buat user baru (Layer 1 - Basic Member)
                $user = User::create([
                    'id' => (string) Str::uuid(),
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'password' => bcrypt(Str::random(24)),
                    'level' => 1,
                    'member_type' => 'basic',
                    'agreed_to_terms' => true,
                    'terms_agreed_at' => now(),
                    'registration_ip' => request()->ip(),
                    'email_verified_at' => now(),
                ]);

                // INTEGRASI ROLE: Berikan role basic_member secara otomatis
                $user->assignRole('basic_member');
            }

            Auth::login($user);
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            // Tampilkan error jika dalam mode local untuk debugging
            if (config('app.debug')) {
                dd($e->getMessage());
            }
            return redirect('/login')->with('error', 'Gagal login menggunakan Google.');
        }
    }
}
