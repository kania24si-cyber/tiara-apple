<?php

namespace App\Http\Controllers;

use App\Models\Multipleuploads;
use Illuminate\Http\Request;

class MultipleuploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('multipleuploads');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required',
            'filename.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'
        ]);

        if ($request->hasfile('filename')) {
            $files = [];
            foreach ($request->file('filename') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    // >>>> TAMBAHAN: simpan juga di storage agar seragam
                    $file->storeAs('public/pelanggan', $filename);

                    $files[] = [
                        'filename' => $filename,
                    ];
                }
            }
            Multipleuploads::insert($files);
            echo 'Success';
        } else {
            echo 'Gagal';
        }
    }

    public function show(Multipleuploads $multipleuploads)
    {
        //
    }

    public function edit(Multipleuploads $multipleuploads)
    {
        //
    }

    public function update(Request $request, Multipleuploads $multipleuploads)
    {
        //
    }

    public function destroy(Multipleuploads $multipleuploads)
    {
        //
    }
}
