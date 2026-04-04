<?php

namespace App\Http\Controllers\MemberBasic\Bayu;

// 3/31/2026 Edit Bayu - Controller baru untuk fitur E-Learning Modul Layer 1
use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\LearningModule;
use App\Models\UserLearningProgress;
use Illuminate\Http\Request;

class LearningModuleController extends Controller
{
    /**
     * Halaman Daftar Semua Modul E-Learning yang dipublikasikan
     */
    public function index()
    {
        $user = auth()->user();

        // Ambil semua modul yang aktif, beserta materials-nya sekaligus (eager loading)
        $modules = LearningModule::published()->with('materials')->get();

        // Hitung progress setiap modul untuk user yang sedang login
        $progressMap = [];
        foreach ($modules as $module) {
            $progressMap[$module->id] = $module->progressForUser($user);
        }

        return view('member_basic.bayu.modules.index', compact('modules', 'progressMap'));
    }

    /**
     * Halaman Detail Modul: Daftar Materi + Nonton/Baca Materi
     */
    public function show($slug)
    {
        $user = auth()->user();
        $module = LearningModule::where('slug', $slug)
            ->published()
            ->with('materials')
            ->firstOrFail();

        // Ambil semua ID materi yang sudah diselesaikan user di modul ini
        $completedIds = UserLearningProgress::where('user_id', $user->id)
            ->whereIn('learning_material_id', $module->materials->pluck('id'))
            ->pluck('learning_material_id')
            ->toArray();

        $progress = $module->progressForUser($user);

        return view('member_basic.bayu.modules.show', compact('module', 'completedIds', 'progress'));
    }

    /**
     * Aksi "Selesai Tonton/Baca" - Klaim XP per Materi
     */
    public function markDone(Request $request, $materialId)
    {
        $user = auth()->user();
        $material = LearningMaterial::findOrFail($materialId);

        // 3/31/2026 Edit Bayu - Anti-cheating: cegah klaim XP lebih dari sekali per materi
        $alreadyDone = UserLearningProgress::where('user_id', $user->id)
            ->where('learning_material_id', $material->id)
            ->exists();

        if ($alreadyDone) {
            return back()->with('info', 'Anda sudah menyelesaikan materi ini sebelumnya!');
        }

        UserLearningProgress::create([
            'user_id'              => $user->id,
            'learning_material_id' => $material->id,
            'xp_earned'            => $material->xp_reward,
            'completed_at'         => now(),
        ]);

        return back()->with('success', "🎉 Keren! Kamu mendapat +{$material->xp_reward} XP Kompetensi!");
    }

    /**
     * Halaman Player/Reader untuk satu Materi spesifik
     */
    public function showMaterial($materialId)
    {
        $user = auth()->user();
        $material = LearningMaterial::with('module.materials')->findOrFail($materialId);

        $isDone = UserLearningProgress::where('user_id', $user->id)
            ->where('learning_material_id', $material->id)
            ->exists();

        // Materi Sebelumnya & Selanjutnya untuk navigasi
        $allMaterials = $material->module->materials;
        $currentIndex = $allMaterials->search(fn($m) => $m->id === $material->id);
        $prevMaterial = $currentIndex > 0 ? $allMaterials[$currentIndex - 1] : null;
        $nextMaterial = $currentIndex < $allMaterials->count() - 1 ? $allMaterials[$currentIndex + 1] : null;

        return view('member_basic.bayu.modules.material', compact('material', 'isDone', 'prevMaterial', 'nextMaterial'));
    }
}
