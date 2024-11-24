<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('seller.products', compact('products'));
    }

    public function addProduct()
    {
        $category = Category::all();
        return view('seller.products.add', compact('category'));
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
}
