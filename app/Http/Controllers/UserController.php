<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query) use ($search) {
            return $query->where('username', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        })->orderBy('id_user', 'desc')->paginate(10)->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Admin,Operator',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));
            $user = User::findOrFail($decryptedId);
            return view('users.edit', compact('user')); // <-- Ubah ke users.edit
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Akses tidak valid!'); // <-- Ubah ke users.index
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));
            $user = User::findOrFail($decryptedId);
            $request->validate([
                'username' => 'required|max:30|unique:users,username,' . $user->id_user . ',id_user',
                'role'     => 'required|in:Admin,Operator',
                'password' => 'nullable|min:6',
            ]);

            $data = [
                'username' => $request->username,
                'role'     => $request->role,
            ];

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);

            return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() === $user->id_user) {
            return back()->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
