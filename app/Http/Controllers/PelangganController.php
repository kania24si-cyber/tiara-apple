<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Multipleuploads; // >>>> TAMBAHAN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // >>>> TAMBAHAN

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['gender'];
        $searchableColumn = ['First_name', 'last_name', 'email'];

        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumn)
            ->paginate(10)->onEachSide(2);

        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        $pelanggan = Pelanggan::create($data);

        // >>>> TAMBAHAN: handle multiple file upload saat create
        if ($request->hasFile('filename')) {
            $files = $request->file('filename');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $original = $file->getClientOriginalName();
                    $filename = time().'-'.str_replace(' ','-',$original);
                    // store di storage/app/public/pelanggan/
                    $storedPath = $file->storeAs('public/pelanggan', $filename);

                    Multipleuploads::create([
                        'pelanggan_id' => $pelanggan->pelanggan_id,
                        'filename' => $filename,
                        'filepath' => 'storage/pelanggan/' . $filename, // path untuk akses via public/storage
                        'filesize' => $file->getSize(),
                    ]);
                }
            }
        }
        // <<<< END TAMBAHAN

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // >>>> TAMBAHAN: view detail pelanggan beserta file
        $data['dataPelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.show', $data);
        // <<<< END TAMBAHAN
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan_id = $id;
        $pelanggan    = Pelanggan::findOrFail($pelanggan_id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        $pelanggan->save();

        // >>>> TAMBAHAN: handle multiple upload saat edit (tambah file baru)
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                if ($file->isValid()) {
                    $original = $file->getClientOriginalName();
                    $filename = time().'-'.str_replace(' ','-',$original);
                    $storedPath = $file->storeAs('public/pelanggan', $filename);

                    Multipleuploads::create([
                        'pelanggan_id' => $pelanggan->pelanggan_id,
                        'filename' => $filename,
                        'filepath' => 'storage/pelanggan/' . $filename,
                        'filesize' => $file->getSize(),
                    ]);
                }
            }
        }
        // <<<< END TAMBAHAN

        return redirect()->route('pelanggan.index')->with('success', 'perubahan data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('succes', 'data berhasil dihapus');
    }
}
