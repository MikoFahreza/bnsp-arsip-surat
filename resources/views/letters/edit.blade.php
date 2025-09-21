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
        <h2 class="mt-4">Edit Arsip Surat</h2>
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
        <form action="{{ route('letters.update', $letter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
                <div class="col-sm-9">
                    <input type="text" name="nomor_surat" class="form-control" value="{{ $letter->nomor_surat }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->name }}" {{ $letter->kategori == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="title" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" value="{{ $letter->title }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date" class="col-sm-3 col-form-label">Tanggal Surat</label>
                <div class="col-sm-9">
                    <input type="date" name="date" class="form-control" value="{{ $letter->date ?? '' }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="file" class="col-sm-3 col-form-label">File Surat (PDF)</label>
                <div class="col-sm-6">
                    <input type="file" name="file" class="form-control" accept="application/pdf">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                </div>
            </div>
            <div class="mb-3 flex gap-2">
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition" onclick="window.location='{{ route('letters.index') }}'">&lt;&lt; Kembali</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
