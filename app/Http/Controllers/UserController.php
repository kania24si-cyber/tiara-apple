<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // ============================
    // LIST USER
    // ============================
    public function index(Request $request)
{
    $data['dataUser'] = User::paginate(10)->onEachSide(2);

    return view('admin.user.index', $data);
}


    // ============================
    // FORM TAMBAH
    // ============================
    public function create()
    {
        return view('admin.user.create');
    }

    // ============================
    // SIMPAN USER BARU
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Upload foto profil
        $path = null;
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'profile_picture' => $path,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // ============================
    // DETAIL USER
    // ============================
    public function show($id)
    {
        $dataUser = User::findOrFail($id);
        return view('admin.user.index', compact('dataUser'));
    }

    // ============================
    // FORM EDIT
    // ============================
    public function edit($id)
    {
        $dataUser = User::findOrFail($id);
        return view('admin.user.edit', compact('dataUser'));
    }

    // ============================
    // UPDATE USER
    // ============================
    public function update(Request $request, $id)
    {
        $dataUser = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dataUser->id,
            'password' => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Jika foto diganti
        if ($request->hasFile('profile_picture')) {

            // Hapus foto lama
            if (!empty($dataUser->profile_picture)) {
                Storage::disk('public')->delete($dataUser->profile_picture);
            }

            // Simpan foto baru
            $dataUser->profile_picture = 
                $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Update data
        $dataUser->name = $request->name;
        $dataUser->email = $request->email;

        if ($request->password) {
            $dataUser->password = Hash::make($request->password);
        }

        $dataUser->save();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    // ============================
    // HAPUS USER
    // ============================
    public function destroy($id)
    {
        $dataUser = User::findOrFail($id);

        // Hapus foto
        if (!empty($dataUser->profile_picture)) {
            Storage::disk('public')->delete($dataUser->profile_picture);
        }

        $dataUser->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
