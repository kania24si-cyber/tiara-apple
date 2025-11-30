@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <h1 class="h4">Detail Pelanggan</h1>
</div>

<div class="card shadow border-0">
    <div class="card-body">

        <h5>Informasi Pelanggan</h5>
        <table class="table">
            <tr><th>Nama</th><td>{{ $dataPelanggan->first_name }} {{ $dataPelanggan->last_name }}</td></tr>
            <tr><th>Email</th><td>{{ $dataPelanggan->email }}</td></tr>
            <tr><th>Phone</th><td>{{ $dataPelanggan->phone }}</td></tr>
            <tr><th>Gender</th><td>{{ $dataPelanggan->gender }}</td></tr>
            <tr><th>Birthday</th><td>{{ $dataPelanggan->birthday }}</td></tr>
        </table>

        <h5 class="mt-4">File Upload</h5>
        <ul class="list-group">
            @forelse($dataPelanggan->files as $file)
            <li class="list-group-item d-flex justify-content-between">
                <a href="{{ asset($file->filepath) }}" target="_blank">{{ $file->filename }}</a>
                <span>{{ round($file->filesize/1024,2) }} KB</span>
            </li>
            @empty
            <li class="list-group-item">Tidak ada file.</li>
            @endforelse
        </ul>

        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mt-3">Kembali</a>

    </div>
</div>
@endsection
