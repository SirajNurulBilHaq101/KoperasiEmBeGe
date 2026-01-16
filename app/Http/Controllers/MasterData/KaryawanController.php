<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = User::whereIn('role', [
            'karyawan_lapangan',
            'operator_dashboard'
        ])
            ->orderBy('name')
            ->get();


        return view('masterData.dataKaryawan', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|in:karyawan_lapangan,operator_dashboard',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('data-karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('data-karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus');
    }
}
