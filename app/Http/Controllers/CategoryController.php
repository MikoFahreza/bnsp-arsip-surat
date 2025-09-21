<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Tampilkan daftar kategori dan pencarian
    public function index(Request $request)
    {
        $query = Category::query();
        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
        }
        $categories = $query->orderBy('id')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    // Tampilkan form tambah kategori
    public function create()
    {
        $lastId = Category::max('id');
        $nextId = $lastId ? $lastId + 1 : 1;
        return view('categories.create', compact('nextId'));
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $lastId = Category::max('id');
        $nextId = $lastId !== null ? $lastId + 1 : 0;
        Category::create([
            'id' => $nextId,
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Tampilkan form edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'description'));
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
