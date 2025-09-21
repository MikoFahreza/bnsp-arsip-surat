@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-2 bg-light" style="min-height: 100vh; border-radius: 12px 0 0 12px;">
        <h5 class="mt-4 mb-4 text-center text-dark" style="font-weight:700;letter-spacing:1px;">Menu</h5>
        <ul class="nav flex-column mb-4">
            <li class="nav-item mb-2"><a class="nav-link rounded-pill px-3 py-2" style="font-weight:500;" href="{{ route('letters.index') }}">Arsip</a></li>
            <li class="nav-item mb-2"><a class="nav-link rounded-pill px-3 py-2" style="font-weight:500;" href="#">Kategori Surat</a></li>
            <li class="nav-item mb-2"><a class="nav-link rounded-pill px-3 py-2" style="font-weight:500;" href="{{ route('about') }}">About</a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <h2 class="mt-4">Arsip Surat &gt;&gt; Unggah</h2>
        <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.<br>
        <strong>Catatan:</strong><br>
        &bull; Gunakan file berformat PDF
        </p>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('letters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row items-center">
                <label for="nomor_surat" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Nomor Surat</label>
                <div class="col-sm-9">
                    <input type="text" name="nomor_surat" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="kategori" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <div class="col-sm-9">
                    <select name="kategori" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="title" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="file" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">File Surat (PDF)</label>
                <div class="col-sm-6">
                    <input type="file" name="file" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" accept="application/pdf" required>
                </div>
            </div>
            <div class="mb-3 flex gap-2">
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition" onclick="window.location='{{ route('letters.index') }}'">&lt;&lt; Kembali</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
