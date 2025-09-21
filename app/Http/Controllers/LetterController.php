<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{
    // Tampilkan form upload surat
    public function create()
    {
    $categories = \App\Models\Category::orderBy('name')->get();
    return view('letters.create', compact('categories'));
    }

    // Simpan surat ke database dan upload file
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'file' => 'required|mimes:pdf|max:20480', // max 20MB
        ]);

        $filePath = $request->file('file')->store('letters', 'public');

        $letter = Letter::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'file_path' => $filePath,
        ]);

        return redirect()->route('letters.index')->with('success', 'Surat berhasil diarsipkan!');
    }

    // Tampilkan daftar surat dan fitur pencarian
    public function index(Request $request)
    {
        $query = Letter::query();
        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(title) LIKE ?', ['%' . $search . '%']);
        }
        $letters = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('letters.index', compact('letters'));
    }

    // Download file surat
    public function download($id)
    {
        $letter = Letter::findOrFail($id);
        return response()->download(storage_path('app/public/' . $letter->file_path));
    }

    // Tampilkan detail surat
    public function show($id)
    {
        $letter = Letter::findOrFail($id);
        return view('letters.show', compact('letter'));
    }

    // Tampilkan form edit surat
    public function edit($id)
    {
    $letter = Letter::findOrFail($id);
    $categories = \App\Models\Category::orderBy('name')->get();
    return view('letters.edit', compact('letter', 'categories'));
    }

    // Update data surat
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:20480', // max 20MB
        ]);

        $letter = Letter::findOrFail($id);

        $data = [
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($letter->file_path);
            // Simpan file baru
            $data['file_path'] = $request->file('file')->store('letters', 'public');
        }

        $letter->update($data);

        return redirect()->route('letters.show', $letter->id)->with('success', 'Surat berhasil diperbarui!');
    }

    // Hapus surat
    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);
        // Hapus file PDF
        Storage::disk('public')->delete($letter->file_path);
        $letter->delete();
        return redirect()->route('letters.index')->with('success', 'Surat berhasil dihapus!');
    }
}
