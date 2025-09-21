@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3 bg-light" style="min-height: 100vh;">
        <h5 class="mt-4">Menu</h5>
        <ul class="nav flex-column mb-4">
            <li class="nav-item mb-2"><a class="nav-link" href="{{ route('letters.index') }}">Arsip</a></li>
            <li class="nav-item mb-2"><a class="nav-link active" href="{{ route('categories.index') }}">Kategori Surat</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="{{ route('about') }}">About</a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <h2 class="mt-4">Tambah Kategori Surat</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3 row items-center">
                <label class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">ID Berikutnya</label>
                <div class="col-sm-9">
                    <input type="text" class="border rounded px-3 py-2 w-full bg-gray-100 text-gray-500" value="{{ $nextId }}" readonly>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="name" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="description" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <div class="col-sm-9">
                    <input type="text" name="description" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300">
                </div>
            </div>
            <div class="mb-3 flex gap-2">
                <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">&lt;&lt; Kembali</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
