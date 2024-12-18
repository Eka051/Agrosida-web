<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category', 'user')->get();
        return view('admin.mengelolaProduk', data: compact('products'));
    }

    public function detailProduct($product_id)
    {
        $product = Product::with('category', 'user')->find($product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
        return view('detailProduk', ['product' => $product]);
    }

    // public function search(Request $request)
    // {
    //     $search = $request->get('search');
    //     $products = Product::with('category')
    //         ->when($search, function($query, $search) {
    //             return $query->where('product_name', 'like', "%{$search}%")
    //             ->orWhereHas('category', function($query) use ($search) {
    //                 $query->where('name', 'like', "%{$search}%");
    //             });
    //         })->get();
    //     return view('admin.mengelolaProduk', compact('products'));
    // }

    public function addProduct()
    {
        $categories = Category::all();
        return view('seller.tambahProduk', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255|unique:products,product_name',
            'description' => 'required',
            'price' => 'required|string|min:1',
            'stock' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'category_id' => 'nullable|exists:categories,category_id',
            'new_category' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    
        try {
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $name, 'public');
            if (!$path) {
                return redirect()->back()->with('error', 'Gagal menyimpan gambar produk.');
            }
            // dd($validated);
            $validated['price'] = (float) str_replace(['Rp', '.', ' '], '', $validated['price']);
            
            $category = $validated['category_id'] ?? 
                ($validated['new_category']
                 ? Category::firstOrCreate(['name' => $validated['new_category']])->category_id : null);
            
            if(!$category) {
                return redirect()
                    ->back()
                    ->with('error', 'Kategori harus diisi/dipilih!');
            }

            Product::create([
                'product_name' => $validated['product_name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'weight' => $validated['weight'],
                'category_id' => $category,
                'created_by' => auth()->user()->user_id,
                'image_path' => str_replace('public/', '', $path),
            ]);
    
            return redirect()
                ->route('seller.view-product')
                ->with('success', 'Produk berhasil ditambahkan.');
    
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan produk. Silakan coba lagi. ' . $e->getMessage());
        }
    }
    

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if($product){
            $product->delete();
            return redirect()->route('admin.view-product')->with('success', 'Produk berhasil dihapus');
        }
    }
   
    public function discontinue($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->discontinued = 1;
            $product->save();
            DB::commit();
            return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus produk');
        }
    }

    public function editProduk($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('seller.editProduk', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|string|min:1',
            'stock' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'category_id' => 'nullable|exists:categories,category_id',
            'new_category' => 'nullable|string|max:255|required_without:category_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $product = Product::findOrFail($id);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('products', $name);
                Storage::delete('public/' . $product->image_path);
                $product->image_path = str_replace('public/', '', $path);
            }

            $validated['price'] = (float) str_replace(['Rp', '.', ' '], '', $validated['price']);

            $product->update([
                'product_name' => $validated['product_name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'weight' => $validated['weight'],
                'category_id' => $validated['category_id'],
            ]);

            if (!$validated['category_id'] && $validated['new_category']) {
                $category = Category::firstOrCreate(['name' => $validated['new_category']]);
                $product->update(['category_id' => $category->category_id]);
            }

            return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil diubah.');

        } catch (\Exception $e) {
            Log::error('Error saat mengubah produk: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Gagal mengubah produk. Silakan coba lagi.');
        }
    }

    public function viewProduct()
    {
        $user = auth()->user();
        $products = Product::whereHas('user', function ($query) use ($user) {
            $query->where('user_id', $user->user_id);
        })
        ->with(['user.store', 'category'])
        ->where('discontinued', 0)
        ->get();

        return view('seller.produk', compact('products'));
    }

}