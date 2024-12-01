<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $products = Product::with('category')
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                ->orWhereHas('category', function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            })->get();
        return view('admin.mengelolaProduk', compact('products', ));
    }

    public function addProduct()
    {
        $categories = Category::all();
        return view('seller.tambahProduk', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,category_id',
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

    public function edit(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'dicontinued' => 'required|in:0,1'
        ]);

        DB::beginTransaction();
        try {
            $product->update($request->all());
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
                $product->file_path = $name;
                $product->save();
            }
            DB::commit();
            return redirect()->route('admin.view-product')->with('success', 'Produk berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah produk');
        }
    }

    public function delete(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            return redirect()->route('admin.view-product')->with('success', 'Produk berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus produk');
        }
    }

    public function discontinue(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->dicontinued = 1;
            $product->save();
            DB::commit();
            return redirect()->route('seller.product')->with('success', 'Produk berhasil dihentikan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghentikan produk');
        }
    }
    
}
