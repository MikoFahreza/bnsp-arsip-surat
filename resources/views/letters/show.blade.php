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
        <h2 class="mt-4">Arsip Surat &gt;&gt; Lihat</h2>
        <div class="mb-3">
            <strong>Nomor:</strong> {{ $letter->nomor_surat }}<br>
            <strong>Kategori:</strong> {{ $letter->kategori }}<br>
            <strong>Judul:</strong> {{ $letter->title }}<br>
            <strong>Waktu Unggah:</strong> {{ $letter->created_at->format('Y-m-d H:i') }}
        </div>
        <div class="border mb-3" style="height:400px;overflow:auto;background:#eee;display:flex;align-items:center;justify-content:center;">
            <iframe src="{{ asset('storage/' . $letter->file_path) }}" width="90%" height="380px"></iframe>
        </div>
        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('letters.index') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
            <a href="{{ route('letters.download', $letter->id) }}" class="btn btn-warning">Unduh</a>
            <a href="{{ route('letters.edit', $letter->id) }}" class="btn btn-info">Edit/Ganti File</a>
        </div>
    </div>
</div>
@endsection
