<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = \App\Models\User::where('name', 'like', '%Basic Member Testing%')->first();
if (!$user) {
    echo "User not found.\n";
    exit;
}

// Find all enrollments for this user
$enrollments = \App\Models\CourseEnrollment::where('user_id', $user->id)->get();
foreach ($enrollments as $enrollment) {
    echo "Deleting enrollment for course: " . $enrollment->course->title . "\n";
    $enrollment->delete();
}

// Delete module progress
$deletedModules = \App\Models\ModuleProgress::where('user_id', $user->id)->delete();
echo "Deleted {$deletedModules} module progress records.\n";

// Delete task submissions just in case
$deletedTasks = \App\Models\TaskSubmission::where('user_id', $user->id)->delete();
echo "Deleted {$deletedTasks} task submission records.\n";

echo "Reset completed for user: {$user->name}. You can now test enrolling again!\n";
