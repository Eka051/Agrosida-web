@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Hitung Kalkulasi Pestisida')
@section('content')
<div class="ml-56 flex-1">
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Hitung Kalkulasi Pestisida</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Admin dapat menghitung kebutuhan pestisida berdasarkan data statis</p>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form class="space-y-6" id="pesticide-form">
                <!-- Nama Pestisida -->
                <div>
                    <label for="pestisida" class="block text-xl font-medium text-gray-700">Nama Pestisida</label>
                    <select id="pestisida_select" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="" disabled selected>Pilih Pestisida</option>
                        @foreach($pesticides as $pesticide)
                            <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Tanaman -->
                <div>
                    <label for="tanaman" class="block text-xl font-medium text-gray-700">Nama Tanaman</label>
                    <select id="selected_tanaman" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="" disabled selected>Jenis Tanaman</option>
                    </select>
                </div>

                <!-- Luas Lahan -->
                <div>
                    <label for="land_area" class="block text-xl font-medium text-gray-700">Luas Lahan (m<sup>2</sup>)</label>
                    <input type="text" id="land_area_value" name="luas_lahan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                        placeholder="Ketik luas lahan">
                </div>

                <!-- Dosis -->
                <div>
                    <label for="dosage" class="block text-xl font-medium text-gray-700">Dosis (ml/m<sup>2</sup>)</label>
                    <input type="number" id="dosage" required min="0" step="0.1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                        placeholder="Ketik Dosis">
                </div>

                <!-- Tombol Hitung -->
                <div class="flex justify-end">
                    <button type="button" id="calculate-btn"
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Hitung
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-lg font-bold text-gray-800">Hasil Kalkulasi</h2>
            <div class="mt-4 space-y-2 text-gray-600">
                <p>Nama Pestisida: <span class="font-medium" id="pesticide-name"></span></p>
                <p>Luas Lahan: <span class="font-medium" id="land-area"></span> m<sup>2</sup></p>
                <p>Dosis: <span class="font-medium" id="dosage-value"></span> ml/m<sup>2</sup></p>
                <p>Total Kebutuhan Pestisida: <span class="font-medium" id="total-pesticide"></span> ml</p>
                <p>Total Kebutuhan Air: <span class="font-medium" id="water-value"></span> liter</p>
            </div>
        </div>
    </section>

    <script>
    $(document).ready(function () {
        $('#pestisida_select').on('change', function () {
            const pestisidaId = $(this).val();

            $.ajax({
                type: 'GET',
                url: `/dosage/${pestisidaId}`,
                success: function (data) {
                    $('#selected_tanaman').empty().append('<option value="" disabled selected>Jenis Tanaman</option>');

                    data.forEach(item => {
                        $('#selected_tanaman').append(
                            `<option value="${item.id}" data-dose="${item.dosage_per_hectare}">${item.name}</option>`
                        );
                    });
                },
                error: function () {
                    alert('Terjadi kesalahan saat mengambil data tanaman');
                }
            });
        });

        $('#selected_tanaman').on('change', function () {
            const selectedDose = $(this).find('option:selected').data('dose');
            $('#dosage').val(selectedDose || '');
        });

        $('#calculate-btn').on('click', function () {
            const landArea = parseFloat($('#land_area_value').val());
            const dosage = parseFloat($('#dosage').val());

            if (isNaN(landArea) || isNaN(dosage)) {
                alert('Masukkan nilai valid untuk luas lahan dan dosis.');
                return;
            }

            const totalPesticide = landArea * dosage;
            const totalWater = landArea / 4;

            $('#pesticide-name').text($('#pestisida_select option:selected').text());
            $('#land-area').text(landArea.toFixed(2));
            $('#dosage-value').text(dosage.toFixed(2));
            $('#total-pesticide').text(totalPesticide.toFixed(2));
            $('#water-value').text(totalWater.toFixed(2));
        });
    });
    </script>



     <!-- Form Tambah Pestisida -->
     <section class="py-8 mx-4">

        <div class="bg-white shadow rounded-lg p-6">
            <label for="setting_pestisida" class="block text-xl font-medium text-gray-700">Daftar Pestisida</label>

            <table class="min-w-full mt-6 table-auto border-collapse rounded-lg overflow-hidden shadow-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">ID</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama Pestisida</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pesticides as $pesticide)
                    <tr class="hover:bg-gray-100 transition duration-150">
                        <td class="px-4 py-2 font-medium text-gray-700">{{ $pesticide->id }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ $pesticide->name }}</td>
                        <td class="px-4 py-2 text-gray-600 flex space-x-4">
                            <!-- Form untuk Hapus -->
                            <form action="{{ route('admin.deletePesticide', $pesticide->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-500 hover:text-red-700 focus:outline-none focus:underline"
                                        onclick="return confirm('Apakah Kamu Yakin ingin menghapus Pestisida Ini?\nFormula Yang berkaitan akan terhapus juga')">
                                    Hapus
                                </button>
                            </form>

                            <!-- Link untuk Edit -->
                            <a href="{{ route('admin.editPesticide', $pesticide->id) }}"
                               class="text-blue-500 hover:text-blue-700 focus:outline-none focus:underline">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <form action="{{ route('addPesticide') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Nama Pestisida -->
                <div>
                    <label for="name" class="block text-xl font-medium text-gray-700">Tambahkan Pestisida</label>
                    <h2 class="mt-2">Nama Pestisida</h2>
                    <input type="text" id="name" name="name" required
                           class="mt-1 block w-full rounded-md border-gray-500 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Ketik Nama Pestisida">
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Form Tambah Tanaman-->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <label for="setting_pestisida" class="block text-xl font-medium text-gray-700">Daftar Tanaman</label>

            <table class="min-w-full mt-6 table-auto border-collapse rounded-lg overflow-hidden shadow-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">ID</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama Tanaman</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($plants as $plant)
                        <tr class="hover:bg-gray-100 transition duration-150">
                            <td class="px-4 py-2 font-medium text-gray-700">{{ $plant->id }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $plant->name }}</td>
                            <td class="px-4 py-2 text-gray-600 flex space-x-4">
                            <form action="{{ route('admin.deletePlant', $plant->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none focus:underline" onclick="return confirm('Apakah Kamu Yakin ingin menghapus Tanaman Ini?\nFormula Yang berkaitan akan terhapus juga')">Hapus</button>
                            </form>
                            <a href="{{ route('admin.editPlant', $plant->id) }}" class="text-blue-500 hover:text-blue-700 focus:outline-none focus:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

            <form action="{{ route('addPlant') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Nama Pestisida -->
                <div>
                    <label for="name" class="block text-xl font-medium text-gray-700">Tambahkan Tanaman</label>
                    <h2 class="mt-2">Nama Tanaman</h2>
                    <input type="text" id="name" name="name" required
                           class="mt-1 block w-full rounded-md border-gray-500 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Ketik Nama Tanaman">
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>

     <!-- Form Tambah Formula Dosis -->
     <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <label for="setting_pestisida" class="block text-xl font-medium text-gray-700">Daftar Formula</label>

            <table class="min-w-full mt-6 table-auto border-collapse rounded-lg overflow-hidden shadow-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">ID</th>
                        <th class="px-4 py-3 text-left font-semibold">Tanaman</th>
                        <th class="px-4 py-3 text-left font-semibold">Pestisida</th>
                        <th class="px-4 py-3 text-left font-semibold">Dosis (ml/m²)</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($dosages as $dosage)
                    <tr class="hover:bg-gray-100 transition duration-150">
                        <td class="px-4 py-2 font-medium text-gray-700">{{ $dosage->id }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ $dosage->plant->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ $dosage->pesticide->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ $dosage->dosage_per_hectare }}</td>
                        <td class="px-4 py-2 text-gray-600 flex space-x-4">
                        <form action="{{ route('admin.deleteDosage', $dosage->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none focus:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus dosis ini?')">Hapus</button>
                        </form>
                        <a href="{{ route('admin.editDosage', $dosage->id) }}" class="text-blue-500 hover:text-blue-700 focus:outline-none focus:underline">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            <form action="{{ route('addDosage') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Nama Pestisida -->
                <div>
                    <label for="name" class="block text-xl font-medium text-gray-700">Tambah Formula</label>

                    <!-- Pilih Nama Pestisida -->
                    <h2 class="mt-4">Nama Pestisida</h2>
                    <select id="pestisida" name="pesticide_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="" disabled selected>Pilih Pestisida</option>
                        <!-- Data Pestisida Dinamis -->
                        @foreach($pesticides as $pesticide)
                            <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                        @endforeach
                    </select>

                    <!-- Pilih Tanaman -->
                    <h2 class="mt-4">Tanaman</h2>
                    <select id="plant" name="plant_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="" disabled selected>Pilih Tanaman</option>
                        <!-- Data Tanaman Dinamis -->
                        @foreach($plants as $plant)
                            <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                        @endforeach
                    </select>

                    <!-- Input Dosis -->
                    <div>
                        <h2 class="mt-4">Dosis (ml/m<sup>2</sup>)</h2>
                        <input type="number" id="dosage" name="dosage_per_hectare" required
                               class="mt-1 block w-full rounded-md border-gray-500 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Ketik Dosis">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>


</div>
@endsection