<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Dosage;
use Illuminate\Http\Request;
use App\Models\Pesticide; // Impor model

class KalkulasiDosisPestisida extends Controller
{
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
}
