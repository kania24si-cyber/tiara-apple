@extends('layouts.admin.app')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 
                               1 0 001 1h3m10-11l2 2m-2-2v10a1 
                               1 0 01-1 1h-3m-6 0a1 1 0 
                               001-1v-4a1 1 0 011-1h2a1 1 0 
                               011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between">
        <div>
            <h1 class="h4">Edit Pelanggan</h1>
            <p class="mb-0">Form untuk memperbarui data pelanggan.</p>
        </div>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">

                {{-- ===================== --}}
                {{-- FORM 1: UPDATE DATA --}}
                {{-- ===================== --}}
                <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" 
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row mb-4">

                        <div class="col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">First name</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ $dataPelanggan->first_name }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Last name</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ $dataPelanggan->last_name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Birthday</label>
                                <input type="date" name="birthday" class="form-control"
                                       value="{{ $dataPelanggan->birthday }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Male" {{ $dataPelanggan->gender=='Male'?'selected':'' }}>Male</option>
                                    <option value="Female" {{ $dataPelanggan->gender=='Female'?'selected':'' }}>Female</option>
                                    <option value="Other" {{ $dataPelanggan->gender=='Other'?'selected':'' }}>Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ $dataPelanggan->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                       value="{{ $dataPelanggan->phone }}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                </form>
                {{-- END FORM UPDATE DATA --}}

                <hr class="my-4">

                {{-- ========================== --}}
                {{-- FORM 2: UPLOAD FILE BARU --}}
                {{-- ========================== --}}
                <h5>Tambah File Baru</h5>

                <form action="{{ route('pelanggan.uploadFile', $dataPelanggan->pelanggan_id) }}"
                      method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Pilih file (bisa banyak)</label>
                        <input type="file" name="filename[]" class="form-control" multiple required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Tambah File
                    </button>
                </form>

                <hr class="my-4">

                {{-- =================== --}}
                {{-- FILE YANG TERUPLOAD --}}
                {{-- =================== --}}
                <h5 class="mt-4">File Yang Sudah Diupload</h5>
                <ul class="list-group mb-4">
                    @forelse($dataPelanggan->files as $file)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            
                            <a href="{{ asset($file->filepath) }}" target="_blank">
                                {{ $file->filename }}
                            </a>

                            <form action="{{ route('pelanggan.deleteFile', $file->id) }}" 
                                  method="POST" onsubmit="return confirm('Yakin hapus file ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>

                        </li>
                    @empty
                        <li class="list-group-item">Belum ada file.</li>
                    @endforelse
                </ul>

            </div>
        </div>
    </div>
</div>

@endsection
