<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Address;
use App\Models\Province;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function index()
    {
        $provinces = $this->fetchProvinces();
        $addresses = Address::where('user_id', auth()->user()->user_id)
        ->with('province', 'city', 'user')
        ->get();
    
        return view('user.address', compact('provinces', 'addresses'));
    }

    private function fetchProvinces()
    {
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.api_key'),
        ])->get('https://api.rajaongkir.com/starter/province');
            
        if ($response->successful()) {
            return $response->json()['rajaongkir']['results'];
        }
    
        return [];
    }
    
    public function fetchCities(Request $request)
    {
        $provinceId = $request->input('province_id');
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.api_key'),
        ])->get("https://api.rajaongkir.com/starter/city?province={$provinceId}");
    
        if ($response->successful() && isset($response['rajaongkir']['results'])) {
            return response()->json($response['rajaongkir']['results']);
        }
    
        return response()->json(['error' => 'Failed to fetch cities'], 500);
    }
    

    public function getShippingCost(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required|numeric',
            'courier' => 'required'
        ]);

        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.api_key'),
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to fetch shipping cost'], 500);
    }

    public function storeAdressSeller(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province' => 'required',
            'province_name' => 'required',
            'city' => 'required',
            'city_name' => 'required',
            'detail_address' => 'required',
        ]);

        $province = Province::firstOrCreate([
            'province_id' => $request->province,
        ], [
            'province_name' => $request->province_name,
        ]);

        $city = City::firstOrCreate([
            'city_id' => $request->city,
        ], [
            'city_name' => $request->city_name,
            'province_id' => $province->province_id,
        ]);

        $address = Address::create([
            'user_id' => auth()->user()->user_id,
            'name' => $request->name,
            'province_id' => $province->province_id,
            'city_id' => $city->city_id,
            'detail_address' => $request->detail_address,
        ]);

        $address->save();
        Log::info('Address created', ['address' => $address]);

        return redirect()->route('profile-seller')->with('success', 'Alamat berhasil ditambahkan');
    }

    public function indexAddressSeller()
    {
        $user = auth()->user();
        $provinces = $this->fetchProvinces();
        $addresses = Address::where('user_id', auth()->user()->user_id)
        ->with('province', 'city', 'user')
        ->get();

        return view('seller.profile-seller', compact('addresses', 'provinces', 'user'));
    }
    public function indexAddressUser()
    {
        $user = auth()->user();
        $address = Address::where('user_id', $user->id)
            ->with('province', 'city', 'user')
            ->first();
        $addresses = $address->getFullAddressAttribute();
        return view('user.profile-user', compact('user', 'addresses'));
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


    public function saveAddress(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province' => 'required', // province_id
            'province_name' => 'required', // province_name
            'city' => 'required',
            'detail_address' => 'required',
        ]);

        $province = Province::firstOrCreate([
            'province_id' => $request->province,
        ], [
            'province_name' => $request->province_name,
        ]);

        $city = City::firstOrCreate([
            'city_id' => $request->city,
        ], [
            'city_name' => $request->city_name,
            'province_id' => $province->province_id,
        ]);

        $address = Address::create([
            'user_id' => auth()->user()->user_id,
            'name' => $request->name,
            'province_id' => $province->province_id,
            'city_id' => $city->city_id,
            'detail_address' => $request->detail_address,
        ]);

        $address->save();

        return redirect()->route('user.add-address')->with('success', 'Alamat berhasil ditambahkan');
    }

    public function editAddress(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $provinces = $this->fetchProvinces();
        
        $provinceId = $request->input('province_id');
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.api_key'),
        ])->get("https://api.rajaongkir.com/starter/city?province={$provinceId}");

        $cities = $response->json()['rajaongkir']['results'];
        return view('user.edit-address', compact('address', 'provinces', 'cities'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province' => 'required',
            'province_name' => 'required',
            'city' => 'required',
            'detail_address' => 'required',
        ]);

        $province = Province::firstOrCreate([
            'province_id' => $request->province,
        ], [
            'province_name' => $request->province_name,
        ]);

        $city = City::firstOrCreate([
            'city_id' => $request->city,
        ], [
            'city_name' => $request->city_name,
            'province_id' => $province->province_id,
        ]);

        $address = Address::findOrFail([
            'user_id' => auth()->user()->user_id,
            'name' => $request->name,
            'province_id' => $province->province_id,
            'city_id' => $city->city_id,
            'detail_address' => $request->detail_address,
        ]);
        $address->save();


        return redirect()->route('user.add-address')->with('success', 'Alamat berhasil diubah');
    }

    public function deleteAddress($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect()->route('user.add-address')->with('success', 'Alamat berhasil dihapus');
    }

    public function getAddress(Request $request)
    {
        $addresses = Address::where('user_id', auth()->user()->user_id)->get();

        return response()->json($addresses);
    }
}