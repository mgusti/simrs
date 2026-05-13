<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Only ID 1 can access
        if (Auth::id() !== 1) {
            abort(403);
        }

        // Show all users except ID 1
        $users = User::where('id', '!=', 1)->get();
        return view('pages.manage-users', [
            'title' => 'Manage Users',
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::id() !== 1) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access_tempat_tidur' => $request->has('access_tempat_tidur'),
            'access_pengaduan' => $request->has('access_pengaduan'),
        ]);

        return back()->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        if (Auth::id() !== 1) {
            abort(403);
        }

        // Do not allow editing user 1
        if ($id == 1) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->access_tempat_tidur = $request->has('access_tempat_tidur');
        $user->access_pengaduan = $request->has('access_pengaduan');
        $user->save();

        return back()->with('success', 'User berhasil diperbarui.');
    }

    public function resetPassword($id)
    {
        if (Auth::id() !== 1) {
            abort(403);
        }

        if ($id == 1) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->password = Hash::make('12345678');
        $user->save();

        return back()->with('success', 'Password user ' . $user->name . ' telah direset ke 12345678.');
    }

    public function destroy($id)
    {
        if (Auth::id() !== 1) {
            abort(403);
        }

        if ($id == 1) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
