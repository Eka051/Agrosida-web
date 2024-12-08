<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Address;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {
        try {
            $provinces = Http::get('https://eka051.github.io/api-wilayah-indonesia/api/provinces.json')->json();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load provinces data.']);
        }

        return view('user.address', compact('provinces'));
    }

    /**
     * Fetch cities based on the selected province ID.
     */
    public function getCities($provinceId)
    {
        try {
            $url = "https://eka051.github.io/api-wilayah-indonesia/api/regencies/{$provinceId}.json";
            $cities = Http::get($url)->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch cities.'], 500);
        }

        return response()->json($cities);
    }

    /**
     * Fetch districts based on the selected city ID.
     */
    public function getDistricts($cityId)
    {
        try {
            $url = "https://eka051.github.io/api-wilayah-indonesia/api/districts/{$cityId}.json";
            $districts = Http::get($url)->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch districts.'], 500);
        }

        return response()->json($districts);
    }

    /**
     * Fetch villages based on the selected district ID.
     */
    public function getVillages($districtId)
    {
        try {
            $url = "https://eka051.github.io/api-wilayah-indonesia/api/villages/{$districtId}.json";
            $villages = Http::get($url)->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch villages.'], 500);
        }

        return response()->json($villages);
    }
    
    

    public function storeAdressSeller(Request $request)
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

    public function editAddressSeller($id)
    {
        $address = Address::find($id);

        return view('seller.address.edit', compact('address'));
    }

    public function updateAddressSeller(Request $request, $id)
    {
        $address = Address::find($id);

        $address->update([
            'name' => $request->name,
        ]);

        return redirect()->route('seller.address.index')->with('success', 'Alamat berhasil diubah');
    }

    public function deleteAddressSeller($id)
    {
        $address = Address::find($id);

        $address->delete();

        return redirect()->route('seller.address.index')->with('success', 'Alamat berhasil dihapus');
    }

    public function addAddress()
    {
        $address = Address::all();
        $provinces = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        return view('user.address', compact('address', 'provinces', 'cities', 'districts', 'villages'));
    }

    public function saveAddress(Request $request)
    {
        $request->validate([
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'street_address' => 'required',
        ]);

        Address::create([
            'user_id' => auth()->user()->user_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'additional_info' => $request->street_address,
        ]);

        return redirect()->view('user.order')->with('success', 'Alamat berhasil ditambahkan');
    }

    public function editAddress($id)
    {
        $address = Address::find($id);

        return view('user.address.edit', compact('address'));
    }

    public function updateAddress(Request $request, $id)
    {
        $request->validate([
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'street_address' => 'required',
        ]);

        $address = Address::find($id);

        $address->update([
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'street_address' => $request->street_address,
            'additional_info' => $request->additional_info,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Alamat berhasil diubah');
    }

    public function deleteAddress($id)
    {
        $address = Address::find($id);

        $address->delete();

        return redirect()->route('user.dashboard')->with('success', 'Alamat berhasil dihapus');
    }

    public function getAddress(Request $request)
    {
        $addresses = Address::where('user_id', auth()->user()->user_id)->get();

        return response()->json($addresses);
    }
}
