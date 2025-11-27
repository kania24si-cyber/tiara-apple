@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">user</a></li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data user</h1>
            <p class="mb-0">List data seluruh user</p>
        </div>
        <div>
            <a href="{{ route('user.create') }}" class="btn btn-success text-white">
                <i class="far fa-question-circle me-1"></i> Tambah user
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow mb-4">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="table-user" class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0">Foto Profil </th>{{-- <<< DITAMBAHKAN --}}
                                <th class="border-0">Name</th>
                                <th class="border-0">Email</th>
                                <th class="border-0">Password</th>
                                <th class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataUser as $item)
                            <tr>

                                <td>
    {{-- Tambahan baru --}}
    @if($item->profile_picture)
        <img src="{{ Storage::url($item->profile_picture) }}" width="50" class="rounded-circle">
    @else
        <span class="text-muted">-</span>
    @endif
</td>


                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->password }}</td>

                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('user.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm text-white">
                                        Edit
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('user.destroy', $item->id) }}"
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
                    {{ $dataUser->links('pagination::bootstrap-5') }}

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
