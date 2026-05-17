<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeminarAdminController extends Controller
{
    public function index()
    {
        $seminars = Seminar::latest()->get();
        return view('admin.seminars.index', compact('seminars'));
    }

    public function create()
    {
        return view('admin.seminars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'type' => 'required|in:online,offline,hybrid,E-Learning',
            'seminar_type' => 'required|in:free,paid',
            'price' => 'nullable|numeric|min:0',
            'quota_total' => 'required|integer|min:1',
            'status' => 'required|in:Open,Full,Closed',
            'meeting_link' => 'nullable|url',
            'grading_type' => 'required|in:auto,manual',
        ]);

        Seminar::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'speaker' => $request->speaker,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'type' => $request->type,
            'seminar_type' => $request->seminar_type,
            'price' => $request->price ?? 0,
            'quota_total' => $request->quota_total,
            'quota_remaining' => $request->quota_total,
            'status' => $request->status,
            'meeting_link' => $request->meeting_link,
            'grading_type' => $request->grading_type,
            'is_active' => true,
        ]);

        return redirect()->route('admin.seminars.index')->with('success', 'Seminar/Webinar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $seminar = Seminar::findOrFail($id);
        return view('admin.seminars.edit', compact('seminar'));
    }

    public function update(Request $request, $id)
    {
        $seminar = Seminar::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'type' => 'required|in:online,offline,hybrid,E-Learning',
            'seminar_type' => 'required|in:free,paid',
            'price' => 'nullable|numeric|min:0',
            'quota_total' => 'required|integer|min:1',
            'status' => 'required|in:Open,Full,Closed',
            'meeting_link' => 'nullable|url',
            'grading_type' => 'required|in:auto,manual',
        ]);

        $diff = $request->quota_total - $seminar->quota_total;
        $newRemaining = max(0, $seminar->quota_remaining + $diff);

        $seminar->update([
            'title' => $request->title,
            'description' => $request->description,
            'speaker' => $request->speaker,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'type' => $request->type,
            'seminar_type' => $request->seminar_type,
            'price' => $request->price ?? 0,
            'quota_total' => $request->quota_total,
            'quota_remaining' => $newRemaining,
            'status' => $request->status,
            'meeting_link' => $request->meeting_link,
            'grading_type' => $request->grading_type,
        ]);

        return redirect()->route('admin.seminars.index')->with('success', 'Seminar/Webinar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $seminar = Seminar::findOrFail($id);
        $seminar->delete();
        return back()->with('success', 'Seminar berhasil dihapus!');
    }

    public function participants($id)
    {
        $seminar = Seminar::findOrFail($id);
        $participants = $seminar->users()->get(); // From BelongsToMany
        return view('admin.seminars.participants', compact('seminar', 'participants'));
    }

    public function verifyPayment($seminar_id, $user_id)
    {
        $seminar = Seminar::findOrFail($seminar_id);
        $seminar->users()->updateExistingPivot($user_id, [
            'payment_status' => 'paid'
        ]);
        
        return back()->with('success', 'Status pembayaran peserta berhasil diverifikasi menjadi LUNAS!');
    }
}
