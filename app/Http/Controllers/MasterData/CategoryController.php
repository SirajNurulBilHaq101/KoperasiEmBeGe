<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(5);
        return view('masterData.kategoriBarang', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $code = strtoupper(Str::slug($request->name, '_'));

        Category::create([
            'code' => $code,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()
            ->route('kategori-barang.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy(Category $category)
    {
        // Optional: cegah hapus kalau masih dipakai item
        if ($category->items()->exists()) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Kategori masih digunakan oleh barang');
        }

        $category->delete();

        return redirect()
            ->route('kategori-barang.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
