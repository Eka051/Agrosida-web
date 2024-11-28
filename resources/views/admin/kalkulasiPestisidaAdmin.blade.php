@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Hitung Kalkulasi Pestisida')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Hitung Kalkulasi Pestisida</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Admin dapat menghitung kebutuhan pestisida berdasarkan data statis</p>
    </section>

    <!-- Form Kalkulasi Pestisida -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form class="space-y-6">
                <!-- Nama Pestisida -->
                <div>
                    <label for="pestisida" class="block text-xl font-medium text-gray-700">Nama Pestisida</label>
                    <select id="pestisida" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="" disabled selected>Pilih Pestisida</option>
                        <!-- Data Pestisida Statis -->
                        <option value="1">Pestisida A</option>
                        <option value="2">Pestisida B</option>
                        <option value="3">Pestisida C</option>
                    </select>
                </div>

                <!-- Luas Lahan -->
                <div>
                    <label for="land_area" class="block text-xl font-medium text-gray-700">Luas Lahan (m<sup>2</sup>)</label>
                    <input type="number" id="land_area" required min="0" step="0.1"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                           value="150">
                </div>

                <!-- Dosis -->
                <div>
                    <label for="dosage" class="block text-xl font-medium text-gray-700">Dosis (ml/m<sup>2</sup>)</label>
                    <input type="number" id="dosage" required min="0" step="0.1"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                           value="15">
                </div>

                <!-- Tombol Hitung -->
                <div class="flex justify-end">
                    <button type="button"
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Hitung
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Hasil Kalkulasi -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-bold text-gray-800">Hasil Kalkulasi</h2>
            <p class="text-gray-600 mt-4">Nama Pestisida: <span class="font-medium">Pestisida A</span></p>
            <p class="text-gray-600 mt-2">Luas Lahan: <span class="font-medium">150 m<sup>2</sup></span></p>
            <p class="text-gray-600 mt-2">Dosis: <span class="font-medium">15 ml/m<sup>2</sup></span></p>
            <p class="text-gray-600 mt-2">Total Kebutuhan Pestisida: 
                <span class="font-medium">2,250 ml</span>
            </p>
        </div>
    </section>
</div>
@endsection
