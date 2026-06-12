<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(15);
        return view('admin.superadmin.users.index', compact('users'));
    }

    /**
     * Menampilkan form penambahan pengguna baru.
     */
    public function create()
    {
        return view('admin.superadmin.users.create');
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:basic_member,admin_layer1,super_admin'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(), // Otomatis aktif
            'agreed_to_terms' => true,
            'terms_agreed_at' => now(),
            'registration_ip' => $request->ip(),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menghapus pengguna (permanen) dari database.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Mencegah super admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->forceDelete();

        return back()->with('success', 'Pengguna berhasil dihapus permanen.');
    }
}
