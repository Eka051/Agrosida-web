<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.mengelolaKategori', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = Category::where('name', $request->name)->first();

        if ($category) {
            return redirect()->route('seller.category.index')->with('error', 'Kategori sudah ada');
        } else {
            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('seller.category.index')->with('success', 'Kategori berhasil ditambahkan');
        }

    }

    public function edit(Request $request, $id)
    {
        $category = Category::find($id);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('seller.category.index')->with('success', 'Kategori berhasil diubah');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->view('admin.mengelolaKategori')->with('success', 'Kategori berhasil dihapus');
    }
}
