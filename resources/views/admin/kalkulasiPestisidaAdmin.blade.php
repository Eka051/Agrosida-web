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

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form class="space-y-6" id="pesticide-form">
                <!-- Nama Pestisida -->
                <div>
                    <label for="pestisida" class="block text-xl font-medium text-gray-700">Nama Pestisida</label>
                    <select id="pestisida_select" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="" disabled selected>Pilih Pestisida</option>
                        <!-- Data Pestisida Dinamis -->
                        @foreach($pesticides as $pesticide)
                            <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                        @endforeach
                    </select>

                    <label for="tanaman" class="block text-xl font-medium text-gray-700 mt-4">Nama Tanaman</label>
                    <select id="selected_tanaman" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="" disabled selected>Jenis Tanaman</option>
                    </select>
                </div>

                <!-- Luas Lahan -->
                <div>
                    <label for="land_area" class="block text-xl font-medium text-gray-700">Luas Lahan (m<sup>2</sup>)</label>
                    <input type="text" id="land_area_value" name="luas_lahan" required
                        class="mt-1 block w-full rounded-md border-gray-500 shadow-sm focus:border-green-500 focus:ring-green-500"
                        placeholder="Ketik luas lahan">
                </div>

                <!-- Dosis -->
                <div>
                    <label for="dosage" class="block text-xl font-medium text-gray-700">Dosis (ml/m<sup>2</sup>)</label>
                    <input type="number" id="dosage" required min="0" step="0.1" value=""
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

    <!-- Hasil Kalkulasi -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-bold text-gray-800">Hasil Kalkulasi</h2>
            <p class="text-gray-600 mt-4">Nama Pestisida: <span class="font-medium" id="pesticide-name"></span></p>
            <p class="text-gray-600 mt-2">Luas Lahan: <span class="font-medium" id="land-area"></span> m<sup>2</sup></p>
            <p class="text-gray-600 mt-2">Dosis: <span class="font-medium" id="dosage-value"></span> ml/m<sup>2</sup></p>
            <p class="text-gray-600 mt-2">Total Kebutuhan Pestisida:
                <span class="font-medium" id="total-pesticide"></span> ml
            </p>
        </div>
    </section>

    <script>
    $(document).ready(function () {
        $('#pestisida_select').on('change', function () {
            var pestisidaId = $(this).val();
            console.log('Selected Pesticide ID:', pestisidaId);

            $.ajax({
                type: 'GET',
                url: '/dosage/' + pestisidaId,
                success: function (data) {
                    console.log('Received Data:', data);
                    $('#selected_tanaman').empty();
                    $('#selected_tanaman').append('<option value="" disabled selected>Jenis Tanaman</option>');

                    $.each(data, function (index, value) {
                        $('#selected_tanaman').append(
                            '<option value="' + value.id + '" data-dose="' + value.dosage_per_hectare + '">' +
                            value.name +
                            '</option>'
                        );
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    alert('Terjadi kesalahan saat mengambil data tanaman');
                }
            });
        });

        $('#selected_tanaman').on('change', function () {
            var selectedDose = $(this).find('option:selected').data('dose');
            console.log('Dose selected:', selectedDose);
            $('#dosage').val(selectedDose);
        });

        $('#calculate-btn').on('click', function () {
            var pestisidaId = $('#pestisida_select').val();
            var landArea = parseFloat($('#land_area_value').val());
            var dosage = parseFloat($('#dosage').val());

            if (isNaN(landArea) || isNaN(dosage)) {
                alert('Silakan masukkan nilai luas lahan dan dosis yang valid.');
                return;
            }

            var totalPesticide = landArea * dosage;

            $('#pesticide-name').text($('#pestisida_select option:selected').text());
            $('#land-area').text(landArea.toFixed(2));
            $('#dosage-value').text(dosage.toFixed(2));
            $('#total-pesticide').text(totalPesticide.toFixed(2));
        });
    });
    </script>

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

     <!-- Form Tambah Pestisida -->
     <section class="py-8 mx-4">

        <div class="bg-white shadow rounded-lg p-6">
            <label for="setting_pestisida" class="block text-xl font-medium text-gray-700">Daftar Pestisida</label>

            <table class="min-w-full mt-6 table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b">ID</th>
                        <th class="px-4 py-2 text-left border-b">Nama Pestisida</th>
                        <th class="px-4 py-2 text-left border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesticides as $pesticide)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $pesticide->id }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesticide->name }}</td>
                        <td class="px-4 py-2 border-b">
                            <!-- Form untuk Hapus -->
                            <form action="{{ route('admin.deletePesticide', $pesticide->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this pesticide?')">Hapus</button>

                                <a href="{{ route('admin.editPlant', $pesticide->id) }}" class="px-3 text-red-500 hover:text-red-700">edit</a>
                            </form>
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
            <table class="min-w-full mt-6 table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b">ID</th>
                        <th class="px-4 py-2 text-left border-b">Nama Tanaman</th>
                        <th class="px-4 py-2 text-left border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plants as $plant)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $plant->id}}</td>
                            <td class="px-4 py-2 border-b">{{ $plant->name }}</td>
                            <td class="px-4 py-2 border-b">
                                <!-- Form untuk Hapus -->
                                <form action="{{ route('admin.deletePlant', $plant->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this pesticide?')">Hapus</button>
                                </form>
                                    <a href="{{ route('admin.editPlant', $plant->id) }}" class="px-3 text-red-500 hover:text-red-700">edit</a>
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
            <table class="min-w-full mt-6 table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b">ID</th>
                        <th class="px-4 py-2 text-left border-b">Tanaman</th>
                        <th class="px-4 py-2 text-left border-b">Pestisida</th>
                        <th class="px-4 py-2 text-left border-b">Dosis ml/m<sup>2</sup></th>
                        <th class="px-4 py-2 text-left border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosages as $dosage)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $dosage->id }}</td>
                            <td class="px-4 py-2 border-b">{{ $dosage->plant->name ?? 'N/A' }}</td> <!-- Menampilkan nama tanaman -->
                            <td class="px-4 py-2 border-b">{{ $dosage->pesticide->name ?? 'N/A' }}</td> <!-- Menampilkan nama pestisida -->
                            <td class="px-4 py-2 border-b">{{ $dosage->dosage_per_hectare }}</td>
                            <td class="px-4 py-2 border-b">

                                <!-- Form untuk Hapus -->
                                <form action="{{ route('admin.deleteDosage', $dosage->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this dosage?')">Hapus</button>
                                </form>
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
