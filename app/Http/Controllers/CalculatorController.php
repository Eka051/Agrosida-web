<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesticide;
use App\Models\Plant;
use App\Models\Dosage;
use App\Models\Product;
use Illuminate\Validation\ValidationException;

class CalculatorController extends Controller
{
    public function landing()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::with(['plant', 'pesticide'])->get();
        $products = Product::with('category')
            ->where('discontinued', 0)
            ->whereNotNull('created_by')
            ->take(6)
            ->get();

        return view('landing', compact('pesticides', 'plants', 'dosages', 'products'));
    }

    public function showForm()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::with(['plant', 'pesticide'])->get();

        return view('admin.kalkulasiPestisidaAdmin', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function showFormSeller()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::with(['plant', 'pesticide'])->get();

        return view('seller.kalkulasiPestisidaSeller', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function showFormUser()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::with(['plant', 'pesticide'])->get();

        return view('user.kalkulasiPestisidaUser', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function addPesticide(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|min:3|max:255',
            ]);

            Pesticide::create([
                'name' => $validatedData['name'],
            ]);

            return redirect()->back()->with('success', 'Pestisida Berhasil Ditambah!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Input tidak sesuai! Pestisida Gagal Ditambah!!');
        }
    }

    public function addPlant(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|min:3|max:255',
            ]);

            Plant::create([
                'name' => $validatedData['name'],
            ]);

            return redirect()->back()->with('success', 'Tanaman Berhasil Ditambah!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Input tidak sesuai! Tanaman Gagal Ditambah!!');
        }
    }

    public function addDosage(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pesticide_id' => 'required|exists:pesticides,id',
                'plant_id' => 'required|exists:plants,id',
                'dosage_per_hectare' => 'required|numeric|min:1',
            ]);

            Dosage::create([
                'plant_id' => $validatedData['plant_id'],
                'pesticide_id' => $validatedData['pesticide_id'],
                'dosage_per_hectare' => $validatedData['dosage_per_hectare'],
            ]);

            return redirect()->back()->with('success', 'Dosis Berhasil Ditambah!!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Dosis Gagal Ditambah!!<br>Pastikan data yang diinputkan benar');
        }
    }

    public function deletePesticide($id)
    {
        $pesticide = Pesticide::find($id);
        if ($pesticide) {
            $pesticide->delete();

            return redirect()->back()->with('success', 'Pestisida berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Pestisida tidak ditemukan!');
    }

    public function deletePlant($id)
    {
        $plant = Plant::find($id);
        if ($plant) {
            $plant->delete();

            return redirect()->back()->with('success', 'Tanaman berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Tanaman tidak ditemukan!');
    }

    public function deleteDosage($id)
    {
        $dosage = Dosage::find($id);
        if ($dosage) {
            $dosage->delete();

            return redirect()->back()->with('success', 'Dosis berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Dosis tidak ditemukan!');
    }

    public function getPlant_by_Pesticide($id)
    {
        $dosages = Dosage::where('pesticide_id', $id)
            ->with('plant')
            ->get();

        $tanaman = $dosages->map(function ($dosage) {
            return [
                'id' => $dosage->plant_id,
                'name' => $dosage->plant->name,
                'dosage_per_hectare' => $dosage->dosage_per_hectare
            ];
        })->unique('id');

        return response()->json($tanaman);
    }

    public function editPlant($id)
    {
        $plant = Plant::find($id);
        if ($plant) {
            return view('admin.updatePlant', compact('plant'));
        }

        return redirect()->back()->with('error', 'Tanaman tidak ditemukan!');
    }

    public function updatePlant(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $updated_plant = Plant::find($id);

        if (!$updated_plant) {
            return back()->with('error', 'Tanaman Gagal Terupdate! Nama tanaman tidak sesuai');
        }

        $updated_plant->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('pesticide.form')->with('success', 'Tanaman Terupdate!');
    }

    public function editPesticide($id)
    {
        $pesticide = Pesticide::find($id);
        if (!$pesticide) {
            abort(404, 'Plant not found');
        }
        return view('admin.updatePesticide', compact('pesticide'));
    }

    public function updatePesticide(Request $request, $id)
    {
        $pesticide = Pesticide::find($id);
        if (!$pesticide) {
            return back()->with('error', 'Pestisida Gagal Terupdate!');
        }

        $pesticide->update([
            'name' => $request->name,
        ]);

        return redirect()->route('pesticide.form')->with('success', 'Pestisida Terupdate!');
    }

    public function editDosage($id)
    {
        $dosage = Dosage::find($id);
        if (!$dosage) {
            abort(404, 'Dosis not found');
        }
        return view('admin.updateDosage', compact('dosage'));
    }

    public function updateDosage(Request $request, $id)
    {
        $validatedData = $request->validate([
            'dosage_per_hectare' => 'required|numeric|min:1',
        ]);

        $dosage = Dosage::with(['plant', 'pesticide'])->find($id);
        if (!$dosage) {
            return back()->with('error', 'Dosis Gagal Terupdate!');
        }

        $dosage->dosage_per_hectare = $validatedData['dosage_per_hectare'];
        $dosage->save();

        return redirect()->route('pesticide.form')->with('success', 'Dosis Terupdate!');
    }
}
