<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductManagementController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'dicontinued' => 'required|in:0,1'
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
                $validated['file_path'] = $name;
            }

            Product::create($validated);
            return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk');
        }
    }

    public function edit(Request $request, $id)
    {
        $product = Product::find($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diubah');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }


}
