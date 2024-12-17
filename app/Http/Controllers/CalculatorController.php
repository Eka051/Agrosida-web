<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesticide;
use App\Models\Plant;
use App\Models\Dosage;

class CalculatorController extends Controller
{
    public function landing()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::all();

        return view('landing', compact('pesticides', 'plants', 'dosages'));
    }

    public function showForm()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::all();

        return view('admin.kalkulasiPestisidaAdmin', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function showFormUser()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::all();

        return view('user.kalkulasiPestisidaUser', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function showFormSeller()
    {
        $pesticides = Pesticide::all();
        $plants = Plant::all();
        $dosages = Dosage::all();

        return view('seller.kalkulasiPestisida', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function addPesticide(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Pesticide::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->back()->with('success', 'Pestisida Berhasil Ditambah!!');
    }

    public function addPlant(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Plant::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->back()->with('success', 'Tanaman Berhasil Ditambah!!');
    }

    public function addDosage(Request $request)
    {
        $validatedData = $request->validate([
            'pesticide_id' => 'required|exists:plants,id',
            'plant_id' => 'required|exists:pesticides,id',
            'dosage_per_hectare' => 'required|numeric|min:0',
        ]);

        Dosage::create([
            'plant_id' => $validatedData['plant_id'],
            'pesticide_id' => $validatedData['pesticide_id'],
            'dosage_per_hectare' => $validatedData['dosage_per_hectare'],
        ]);

        return redirect()->back()->with('success', 'Dosis Berhasil Ditambah!!');
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
            return view('admin.editTanaman', compact('plant'));
        }

        return redirect()->back()->with('error', 'Tanaman tidak ditemukan!');
    }

    public function updatePlant(Request $request, $id)
    {
        $updated_plant = Plant::find($id);

        if (!$updated_plant) {
            return back()->with('error', 'Tanaman Gagal Terupdate!');
        }

        $updated_plant->update([
            'name' => $request->name,
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
        return view('admin.updateDosis', compact('dosage'));
    }

    public function updateDosage(Request $request, $id)
    {
        $dosage = Dosage::find($id);
        if (!$dosage) {
            return back()->with('error', 'Dosis Gagal Terupdate!');
        }

        $dosage->update([
            'plant_id' => $request->plant_id,
            'pesticide_id' => $request->pesticide_id,
            'dosage_per_hectare' => $request->dosage_per_hectare,
        ]);

        return redirect()->route('pesticide.form')->with('success', 'Dosis Terupdate!');
    }
}
