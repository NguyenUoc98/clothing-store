<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[\p{L}\s]+$/u|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/[^\w]/',
            'role' => 'required|in:staff,admin'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);


        return redirect()->route('users.index')->with('success', 'Người dùng mới đã được tạo thành công.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,staff',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Thông tin người dùng đã được cập nhật.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa.');
    }
}
