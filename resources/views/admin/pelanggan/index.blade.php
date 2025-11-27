@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 1 0 1h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data Pelanggan</h1>
            <p class="mb-0">List data seluruh pelanggan</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-success text-white">
                Tambah Pelanggan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">

                    {{-- Search + Filter --}}
                    <form method="GET" action="{{ route('pelanggan.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Search">

                                    <button type="submit" class="input-group-text">
                                        🔍
                                    </button>

                                    @if(request('search'))
                                        <a href="{{ route('pelanggan.index') }}"
                                            class="btn btn-outline-secondary ms-2">
                                            Clear
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-2">
                                <select name="gender" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Male" {{ request('gender')=='Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ request('gender')=='Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    {{-- Table --}}
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Files</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataPelanggan as $item)
                                <tr>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->birthday }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>

                                    {{-- LIST FILE --}}
                                    <td>
                                        @if($item->files->isEmpty())
                                            <span class="text-muted">Tidak ada file</span>
                                        @else
                                            @foreach($item->files as $file)
                                                <div>
                                                    <a href="{{ asset($file->filepath) }}" target="_blank">
                                                        {{ $file->filename }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>

                                    {{-- ACTION --}}
                                    <td>
                                        <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}"
                                            class="btn btn-info btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}"
                                            method="POST" style="display:inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="mt-3">
                        {{ $dataPelanggan->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
