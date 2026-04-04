<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$output = [];
$user = App\Models\User::first();
if (!$user) {
    $output['error'] = "No user found.";
    file_put_contents('test_auth_res.json', json_encode($output));
    exit;
}

$output['first_user_email'] = $user->email;
$attempt = \Illuminate\Support\Facades\Auth::attempt(['email' => $user->email, 'password' => 'password']);
$output['attempt_password'] = $attempt ? 'Success' : 'Failed';

// Try standard DB hash directly check
$output['password_check'] = \Illuminate\Support\Facades\Hash::check('password', $user->password) ? 'Match' : 'No Match';

try {
    $driver = \Laravel\Socialite\Facades\Socialite::driver('google');
    $url = $driver->redirect()->getTargetUrl();
    $output['socialite'] = "Loaded Google driver. Redirect: " . $url;
} catch (\Exception $e) {
    $output['socialite_error'] = $e->getMessage();
}

file_put_contents('test_auth_res.json', json_encode($output, JSON_PRETTY_PRINT));
// Edit Bayu 3/31/2026 Perbaikan Login