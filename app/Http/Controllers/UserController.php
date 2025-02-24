<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::where('role', 'staff')->get();
        $data = [
            'users' => $users
        ];
        return view('user.app', $data);
    }

    public function create() {
        return view('user.create');
    }

    public function store(Request $request) {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $validation['password'] = bcrypt($request->password);
        $validation['role'] = 'staff';

        User::create($validation);
        return redirect()->route('user.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user
        ];
        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $validation['password'] = bcrypt($request->password);

        User::findOrFail($id)->update($validation);
        return redirect()->route('user.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy($id) {
        $sparepart = User::findOrFail($id);
        $sparepart->delete();
        
        return redirect()->route('user.index')->with('success', 'Akun berhasil dihapus.');  
    }
}
