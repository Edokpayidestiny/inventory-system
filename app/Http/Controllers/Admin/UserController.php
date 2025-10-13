<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'User Management',
            'users' =>User::all()
        ];
        return view('admin.users.index', $data);
    }

    public function edit(User $user)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $user
        ];
        return view('admin.users.edit', $data);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required',
        ]);

        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
