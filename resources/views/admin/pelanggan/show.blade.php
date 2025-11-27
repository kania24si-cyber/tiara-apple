@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <!-- breadcrumb ... -->
</div>

<div class="card">
    <div class="card-body">
        <h4>Detail Pelanggan</h4>
        <p><strong>Nama:</strong> {{ $dataPelanggan->first_name }} {{ $dataPelanggan->last_name }}</p>
        <p><strong>Birthday:</strong> {{ $dataPelanggan->birthday }}</p>
        <p><strong>Gender:</strong> {{ $dataPelanggan->gender }}</p>
        <p><strong>Email:</strong> {{ $dataPelanggan->email }}</p>
        <p><strong>Phone:</strong> {{ $dataPelanggan->phone }}</p>

        <hr>
        <h5>Files</h5>
        @if($dataPelanggan->files->isEmpty())
            <p class="text-muted">Belum ada file terupload.</p>
        @else
            <ul>
                @foreach($dataPelanggan->files as $file)
                    <li><a href="{{ asset($file->filepath) }}" target="_blank">{{ $file->filename }}</a> ({{ number_format($file->filesize / 1024, 2) }} KB)</li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
