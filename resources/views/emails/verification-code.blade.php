<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-color: #F9FAFB; font-family: system-ui, -apple-system, sans-serif;">
    <div class="max-w-2xl mx-auto p-4 sm:p-8">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="bg-green-600 px-8 py-6">
                <h1 class="text-2xl font-bold text-white text-center">AGROSIDA</h1>
            </div>
            
            <div class="p-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Verifikasi Email Anda</h2>
                    <p class="text-gray-500 mt-2">Masukkan kode di bawah ini untuk melanjutkan</p>
                </div>
                
                <div class="text-gray-600 mb-6">
                    <p class="mb-4">Halo, User</p>
                    <p class="mb-4">Kami menerima permintaan verifikasi email Anda. Gunakan kode verifikasi berikut:</p>
                </div>

                <div style="background-color: #F9FAFB; border-radius: 0.5rem; padding: 2rem; margin-bottom: 1.5rem; border: 2px dashed #E5E7EB;">
                    <h2 style="font-size: 3rem; font-family: monospace; font-weight: bold; text-align: center; letter-spacing: 1rem; color: #1F2937;">{{ $code }}</h2>
                </div>

                <div style="background-color: #FFFBEB; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem; border-left: 4px solid #FBBF24; display: flex; align-items: center;">
                    <div style="flex-shrink: 0;">
                        <!-- Warning Icon -->
                        <svg style="height: 1.25rem; width: 1.25rem; color: #FBBF24;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div style="margin-left: 0.75rem;">
                        <p style="font-size: 0.875rem; color: #B45309;">
                            Kode ini akan kadaluarsa dalam 5 menit
                        </p>
                    </div>
                </div>
                <div class="text-sm text-gray-500 mb-8">
                    <p class="mb-2">Jika Anda tidak meminta verifikasi email ini, abaikan email ini.</p>
                </div>

                <hr class="my-6 border-gray-200">

                <div class="text-center text-gray-600 text-sm">
                    <p>Terima kasih,</p>
                    <p class="font-semibold text-green-600">Tim Support AGROSIDA</p>
                </div>
            </div>
            
            <div class="bg-gray-50 px-8 py-4 text-center text-xs text-gray-500">
                <p>&copy; 2024 AGROSIDA. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>