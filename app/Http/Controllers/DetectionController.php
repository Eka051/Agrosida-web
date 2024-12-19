<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DetectionController extends Controller
{
    public function showForm()
    {
        return view('admin.detect');
    }

    public function DetectionUser()
    {
        return view('user.detect');
    }

    public function DetectionSeller()
    {
        return view('seller.detect');
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('detection', $name, 'public'); // Perbaikan variabel dari $file ke $image
            if (!$path) {
                return redirect()->back()->with('error', 'Gagal menyimpan gambar.');
            }

            $client = new Client();

            $response = $client->post('http://109.123.234.250:8001/detect', [
                'headers' => [
                    'X-API-Key' => 'akuGanteng',
                ],
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($image->getRealPath(), 'r'),
                        'filename' => $image->getClientOriginalName(),
                    ],
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody(), true);

                return redirect()->back()->with('result', [
                    'class_name' => $result['detected_classes'] ?? ['Tidak ada objek terdeteksi'],
                    'image_path' => $path,
                ]);
            }

            return redirect()->back()->with('error', 'Gagal mendapatkan hasil deteksi dari API.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
