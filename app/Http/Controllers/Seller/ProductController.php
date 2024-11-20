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
        
    }
}
