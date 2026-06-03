<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$courses = \App\Models\ShortCourse::where('grading_type', 'manual')->get();
foreach ($courses as $c) {
    \App\Models\CourseTask::firstOrCreate(
        ['course_id' => $c->id],
        [
            'task_title' => 'Tugas Akhir',
            'task_description' => 'Silakan kumpulkan link tugas akhir Anda untuk dinilai oleh instruktur.',
            'task_point' => 100,
            'submission_type' => 'link_submission'
        ]
    );
    echo "Synced task for: {$c->title}\n";
}
echo "Done\n";
