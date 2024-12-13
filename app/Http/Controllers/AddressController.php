<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Address;
use App\Models\Province;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.api_key'),
        ])->get('https://api.rajaongkir.com/starter/province');
            
        $provinces = [];
        if ($response->successful()) {
            $provinces = $response->json()['rajaongkir']['results'];
        }
    
        $cities = [];
        if ($request->has('province_id')) {
            $cities = $this->getCities($request->province_id);
        }
        dd($cities);
    
        $addresses = Address::where('user_id', auth()->user()->user_id)->get();
    
        return view('user.address', compact('provinces', 'cities', 'addresses'));
    }
    
    /**
     * Fetch cities based on the selected province ID.
     */
    private function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.api_key'),
        ])->get("https://api.rajaongkir.com/starter/city?province={$provinceId}");
    
        if ($response->successful() && isset($response['rajaongkir']['results'])) {
            return $response['rajaongkir']['results'];
        }
    
        return [];
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


    public function saveAddress(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province_id' => 'required',
            'city' => 'required',
            'detail_address' => 'required',
        ]);

        $province = Province::firstOrCreate(
            ['province_name' => $request->province_id]
        );

        $city = City::create([
            'city_name' => $request->city,
            'province_id' => $province->id,
        ]);

        $address = Address::create([
            'user_id' => auth()->user()->user_id,
            'name' => $request->name,
            'province_id' => $province->id,
            'city_id' => $city->id,
            'detail_address' => $request->detail_address,
            'additional_info' => $request->street_address,
        ]);
        $address->save();

        return redirect()->route('user.add-address')->with('success', 'Alamat berhasil ditambahkan');
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

        return redirect()->view('user.address')->with('success', 'Alamat berhasil dihapus');
    }

    public function getAddress(Request $request)
    {
        $addresses = Address::where('user_id', auth()->user()->user_id)->get();

        return response()->json($addresses);
    }
}