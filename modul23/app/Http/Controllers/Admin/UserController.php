<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Daftar role yang tersedia di aplikasi.
     * Tambahkan/ubah sesuai kebutuhan (misal: 'editor', 'staff').
     */
    protected array $availableRoles = ['user', 'admin'];

    public function index(): View
    {
        $users = User::orderBy('name')->paginate(10);

        return view('admin.users.index', [
            'users'          => $users,
            'availableRoles' => $this->availableRoles,
        ]);
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => 'required|string|in:' . implode(',', $this->availableRoles),
        ]);

        // Mencegah admin tidak sengaja menurunkan role dirinya sendiri
        if ($user->id === $request->user()->id && $request->role !== 'admin') {
            return back()->with('error', 'Anda tidak bisa mengubah role akun Anda sendiri.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', "Role {$user->name} berhasil diubah menjadi {$request->role}.");
    }
}
