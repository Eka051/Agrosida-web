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

    public function uploadImage(Request $request)
    {
        // Validasi input gambar
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $image = $request->file('image');
            $client = new Client();

            // Kirim permintaan POST ke API
            $response = $client->post('http://109.123.234.250:8001/detect', [
                'headers' => [
                    'X-API-Key' => 'akuGanteng', // API Key Anda
                ],
                'multipart' => [
                    [
                        'name'     => 'file', // Sesuaikan dengan nama field API FastAPI
                        'contents' => fopen($image->getRealPath(), 'r'),
                        'filename' => $image->getClientOriginalName(),
                    ],
                ],
            ]);

            // Periksa status respon
            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody(), true);

                return redirect()->route('detect.form')->with('result', [
                    'class_name' => $result['detected_classes'] ?? ['Tidak ada objek terdeteksi'],
                ]);
            }

            return redirect()->route('detect.form')->withErrors('Gagal mendapatkan hasil deteksi dari API.');
        } catch (\Exception $e) {
            return redirect()->route('detect.form')->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
