<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.index');
    }

    public function add(Request $request)
    {
        $store = Store::where('name', $request->name)->first();

        if ($store) {
            return redirect()->route('seller.store.index')->with('error', 'Toko sudah ada');
        } else {
            Store::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->route('seller.store.index')->with('success', 'Toko berhasil ditambahkan');
        }

    }

    public function edit(Request $request, $id)
    {
        $store = Store::find($id);

        $store->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('seller.store.index')->with('success', 'Toko berhasil diubah');
    }

    public function delete($id)
    {
        $store = Store::find($id);
        $store->delete();

        return redirect()->route('seller.store.index')->with('success', 'Toko berhasil dihapus');
    }
}
