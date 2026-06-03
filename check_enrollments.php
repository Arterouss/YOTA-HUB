<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$enrollments = \App\Models\CourseEnrollment::with('course', 'user')->get();
foreach ($enrollments as $e) {
    echo "User: {$e->user->name} | Course: {$e->course->title} | Payment Status: {$e->payment_status}\n";
}
