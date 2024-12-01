<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {
        return view('seller.address.index');
    }

    public function add(Request $request)
    {
        $address = Address::where('name', $request->name)->first();

        if ($address) {
            return redirect()->route('seller.address.index')->with('error', 'Alamat sudah ada');
        } else {
            Address::create([
                'name' => $request->name,
            ]);

            return redirect()->route('seller.address.index')->with('success', 'Alamat berhasil ditambahkan');
        }

    }
}
