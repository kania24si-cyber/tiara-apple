@extends('layouts.admin.app')

@section('content')
    <!-- start main content -->
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data user</h1>
                <p class="mb-0">List data seluruh user</p>
            </div>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success text-white"><i
                        class="far fa-question-circle me-1"></i> Tambah user</a>
            </div>
        </div>
    </div>
    {{-- -info tambah data --}}
    @if (session('create'))
        <div class="alert alert-info">
            {{ session('create') }}
    @endif

        {{-- -info Edit data --}}
        @if (session('update'))
            <div class="alert alert-info">
                {{ session('update') }}
        @endif

            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table-pelanggan" class="table table-centered table-nowrap mb-0 rounded">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border-0">Nama Lengkap</th>
                                            <th class="border-0">Email</th>
                                            <th class="border-0">Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataUser as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->password }}</td>
                                                <td>
                                                    <a href=""
                                                        class="btn btn-info btn-sm">
                                                        <svg class="icon icon-xs me-2" data-slot="icon" fill="none"
                                                            stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                                                            </path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action=""
                                                        method="POST">

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end main content -->
@endsection