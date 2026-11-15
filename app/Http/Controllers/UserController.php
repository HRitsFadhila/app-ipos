<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($currentUser->role == 'admin') {
            $role = 'cashier';
        } else {
            $request->validate(['role' => 'required|in:admin,cashier,owner']);
            $role = $request->role;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->role == 'admin' && $user->role == 'owner') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak! Administrator tidak berhak mengedit akun Owner.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->role == 'admin' && $user->role == 'owner') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak! Administrator tidak berhak mengubah akun Owner.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($currentUser->role == 'owner') {
            $request->validate(['role' => 'required|in:admin,cashier,owner']);
            $data['role'] = $request->role;
        } else {
            $data['role'] = $user->role;
        }

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if ($user->id === $currentUser->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        if ($currentUser->role == 'admin' && $user->role == 'owner') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak! Administrator tidak berhak menghapus akun Owner.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil dihapus!');
    }
}
