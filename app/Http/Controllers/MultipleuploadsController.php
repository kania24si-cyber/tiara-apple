<?php

namespace App\Http\Controllers;

use App\Models\Multipleuploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultipleuploadsController extends Controller
{
    /**
     * Display a listing of uploaded files.
     */
    public function index()
    {
        $files = Multipleuploads::all();
        return view('multipleuploads', compact('files'));
    }

    /**
     * Show the form for uploading files.
     */
    public function create()
    {
        return view('multipleuploads');
    }

    /**
     * Store newly uploaded files in storage and DB.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:doc,docx,pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('files')) {
            $filesData = [];

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $filepath = $file->storeAs('public/pelanggan', $filename); // simpan di storage/app/public/pelanggan

                    $filesData[] = [
                        'filename' => $filename,
                        'filepath' => $filepath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Multipleuploads::insert($filesData);

            return redirect()->back()->with('success', 'File berhasil diupload!');
        }

        return redirect()->back()->with('error', 'Tidak ada file yang diupload.');
    }

    /**
     * Remove a file from storage and DB.
     */
    public function destroy($id)
    {
        $file = Multipleuploads::findOrFail($id);

        // Hapus file dari storage
        if (Storage::exists($file->filepath)) {
            Storage::delete($file->filepath);
        }

        $file->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus!');
    }
}
