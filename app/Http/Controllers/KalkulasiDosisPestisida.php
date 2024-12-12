<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Dosage;
use Illuminate\Http\Request;
use App\Models\Pesticide; // Impor model

class KalkulasiDosisPestisida extends Controller
{
    public function landing()
    {
        $pesticides = Pesticide::all(); // Ambil semua data dari model Pesticide
        $plants = Plant::all();
        $dosages = Dosage::all();

        return view('landing', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function showForm()
    {
        $pesticides = Pesticide::all(); // Ambil semua data dari model Pesticide
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
        $pesticides = Pesticide::all(); // Ambil semua data dari model Pesticide
        $plants = Plant::all();
        $dosages = Dosage::all();

        return view('user.kalkulasiPestisidaUser', [
            'pesticides' => $pesticides,
            'plants' => $plants,
            'dosages' => $dosages
        ]);
    }

    public function addPesticide(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Pesticide::create([
            'name' => $validatedData['name'],
        ]);

        // Redirect atau respon balik
        return redirect()->back()->with('success', 'Pestisida Berhasil Ditambah!!');
    }

    public function addPlant(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Plant::create([
            'name' => $validatedData['name'],
        ]);

        // Redirect atau respon balik
        return redirect()->back()->with('success', 'Tanaman Berhasil Ditambah!!');
    }

    public function addDosage(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'plant_id' => 'required|exists:plants,id', // Pastikan plant_id ada di tabel plants
            'pesticide_id' => 'required|exists:pesticides,id', // Pastikan pesticide_id ada di tabel pesticides
            'dosage_per_hectare' => 'required|numeric|min:0', // Validasi angka
        ]);

        // Simpan data ke database
        Dosage::create([
            'plant_id' => $validatedData['plant_id'],
            'pesticide_id' => $validatedData['pesticide_id'],
            'dosage_per_hectare' => $validatedData['dosage_per_hectare'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Formula Berhasil Ditambah!!');
    }

    public function deletePesticide($id)
    {
            // Mencari pestisida berdasarkan ID
        $pesticide = Pesticide::find($id);

        // Jika pestisida ditemukan, hapus
        if ($pesticide) {
            $pesticide->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Pestisida berhasil dihapus!');
        }

        // Jika pestisida tidak ditemukan, beri pesan error
        return redirect()->back()->with('error', 'Pestisida tidak ditemukan!');
    }

    public function deletePlant($id)
    {
            // Mencari pestisida berdasarkan ID
        $plant = Plant::find($id);

        // Jika pestisida ditemukan, hapus
        if ($plant) {
            $plant->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Tanaman berhasil dihapus!');
        }

        // Jika pestisida tidak ditemukan, beri pesan error
        return redirect()->back()->with('error', 'Tanaman tidak ditemukan!');
    }

    public function deleteDosage($id)
    {
            // Mencari pestisida berdasarkan ID
        $dosage = Dosage::find($id);

        // Jika pestisida ditemukan, hapus
        if ($dosage) {
            $dosage->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Formula berhasil dihapus!');
        }

        // Jika pestisida tidak ditemukan, beri pesan error
        return redirect()->back()->with('error', 'Formula tidak ditemukan!');
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


    public function editPlant($id) {
        $plant = Plant::find($id);
        if (!$plant) {
            abort(404, 'Plant not found');
        }
        return view('admin.updatePlant', compact('plant'));
    }


    public function updatePlant(Request $request, $id)
    {
        // Cari data plant berdasarkan ID
        $updated_plant = Plant::find($id);

        // Periksa apakah data ditemukan
        if (!$updated_plant) {
            return back()->with('error', 'Tanaman Gagal Terupdate!');
        }

        // Update data plant
        $updated_plant->update([
            'name' => $request->name,
        ]);

        // Redirect ke halaman form atau halaman lain dengan pesan sukses
        return redirect()->route('pesticide.form')->with('success', 'Tanaman Terupdate!');
    }

    public function editPesticide($id) {
        $pesticide = Pesticide::find($id);
        if (!$pesticide) {
            abort(404, 'Plant not found');
        }
        return view('admin.updatePesticide', compact('pesticide'));
    }


    public function updatePesticide(Request $request, $id)
    {
        // Cari data plant berdasarkan ID
        $updated_pesticide = Pesticide::find($id);

        // Periksa apakah data ditemukan
        if (!$updated_pesticide) {
            return back()->with('error', 'Pestisida Gagal Diupdate!');
        }

        // Update data plant
        $updated_pesticide->update([
            'name' => $request->name,
        ]);

        // Redirect ke halaman form atau halaman lain dengan pesan sukses
        return redirect()->route('pesticide.form')->with('success', 'Pestisida Terupdate!');
    }

    public function editDosage($id) {
        $dosage = Dosage::find($id);
        if (!$dosage) {
            abort(404, 'Dosage not found');
        }
        return view('admin.updateDosage', compact('dosage'));
    }


    public function updateDosage(Request $request, $id)
    {
        // Cari data plant berdasarkan ID
        $updated_dosage = Dosage::find($id);

        // Periksa apakah data ditemukan
        if (!$updated_dosage) {
            return back()->with('error', 'Dosis Gagal Diupdate!');
        }

        // Update data plant
        $updated_dosage->update([
            'dosage_per_hectare' => $request->dosage_per_hectare,
        ]);

        // Redirect ke halaman form atau halaman lain dengan pesan sukses
        return redirect()->route('pesticide.form')->with('success', 'Dosis Terupdate!');
    }

}
