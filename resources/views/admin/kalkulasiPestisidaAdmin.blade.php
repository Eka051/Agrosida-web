@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Hitung Kalkulasi Pestisida')
@section('content')
<div class="ml-56 flex-1">
    {{-- Header Section --}}
    <section class="bg-gradient-to-r from-green-600 to-green-700 p-8 text-center mt-16">
        <h1 class="text-2xl font-bold text-white lg:text-5xl">Kalkulasi Kebutuhan Pestisida</h1>
        <p class="text-gray-100 mt-4 lg:text-xl">Kelola kalkulasi pestisida untuk mengurangi pencemaran lingkungan</p>
    </section>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Calculator Section --}}
            <div class="space-y-6">
                {{-- Calculation Form --}}
                <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b">Kalkulator Pestisida</h2>
                    <form class="space-y-6" id="pesticide-form">
                        <div class="space-y-4">
                            {{-- Original calculation form fields --}}
                            <div>
                                <label for="pestisida" class="block text-sm font-medium text-gray-700">Nama Pestisida</label>
                                <select id="pestisida_select" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                    <option value="" disabled selected>Pilih Pestisida</option>
                                    @foreach($pesticides as $pesticide)
                                    <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tanaman" class="block text-sm font-medium text-gray-700">Nama Tanaman</label>
                                <select id="selected_tanaman" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                    <option value="" disabled selected>Jenis Tanaman</option>
                                </select>
                            </div>

                            <div>
                                <label for="land_area" class="block text-sm font-medium text-gray-700">Luas Lahan (m<sup>2</sup>)</label>
                                <input type="text" id="land_area_value" name="luas_lahan" required
                                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>

                            <div>
                                <input type="hidden" id="dosage" required min="0" step="0.1" readonly disabled
                                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" id="calculate-btn"
                                class="bg-green-600 text-white px-8 py-4 rounded-md text-base hover:bg-green-700 transition duration-300">
                                Hitung
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Results Card --}}
                <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b">Hasil Kalkulasi</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Nama Pestisida</p>
                                <p class="font-medium text-gray-900" id="pesticide-name">-</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Luas Lahan</p>
                                <p class="font-medium text-gray-900"><span id="land-area">-</span> m<sup>2</sup></p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Dosis</p>
                                <p class="font-medium text-gray-900"><span id="dosage-value">-</span> ml/m<sup>2</sup></p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Total Kebutuhan Pestisida</p>
                                <p class="font-medium text-gray-900"><span id="total-pesticide">-</span> ml</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg col-span-2">
                                <p class="text-sm text-gray-600">Total Kebutuhan Air</p>
                                <p class="font-medium text-gray-900"><span id="water-value">-</span> liter</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Management Section --}}
            <div class="space-y-6">
                {{-- Pesticide Management --}}
                <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b">Manajemen Pestisida</h2>
                    
                    {{-- Pesticide List --}}
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- Original pesticide table content --}}
                            <table class="min-w-full divide-y divide-gray-300 border-l border-r border-b border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                <thead class="bg-greenSecondary text-white">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold">ID</th>
                                        <th class="px-4 py-3 text-left font-semibold">Nama Pestisida</th>
                                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pesticides as $pesticide)
                                    <tr class="hover:bg-gray-100 transition duration-150">
                                        <td class="px-4 py-2 font-medium text-gray-700 border-r">{{ $pesticide->id }}</td>
                                        <td class="px-4 py-2 text-gray-600 border-r">{{ $pesticide->name }}</td>
                                        <td class="px-4 py-2 text-gray-600 flex">
                                            <div class="flex-grow space-x-2">
                                                <!-- Form untuk Hapus -->
                                                <form action="{{ route('admin.deletePesticide', $pesticide->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-500 text-white font-medium text-center px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none"
                                                            onclick="event.preventDefault(); confirmDelete({{ $pesticide->id }})">
                                                        Hapus
                                                    </button>
                                                </form>
                    
                                                <!-- Link untuk Edit -->
                                                <a href="{{ route('admin.editPesticide', $pesticide->id) }}"
                                                   class="bg-blue-500 text-white font-medium text-center px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:underline">
                                                    Edit
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </table>
                    </div>

                    {{-- Add Pesticide Form --}}
                    <form action="{{ route('addPesticide') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tambah Pestisida Baru</label>
                            <input type="text" name="name" required
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-8 py-4 rounded-md text-base hover:bg-green-700 transition duration-300">
                                Tambah Pestisida
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Plants Management --}}
                <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b">Manajemen Tanaman</h2>
                    
                    {{-- Plants List --}}
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- Original plants table content --}}
                            <table class="min-w-full divide-y divide-gray-300 border-l border-r border-b border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                <thead class="bg-greenSecondary text-white">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold">ID</th>
                                        <th class="px-4 py-3 text-left font-semibold">Nama Tanaman</th>
                                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($plants as $plant)
                                        <tr class="hover:bg-gray-100 transition duration-150">
                                            <td class="px-4 py-2 font-medium text-gray-700 border-r">{{ $plant->id }}</td>
                                            <td class="px-4 py-2 text-gray-600 border-r">{{ $plant->name }}</td>
                                            <td class="px-4 py-2 text-gray-600 flex space-x-4">
                                                <div class="flex-grow space-x-2">
                                                    <!-- Form untuk Hapus -->
                                                    <form action="{{ route('admin.deletePlant', $plant->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="bg-red-500 text-white font-medium text-center px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none"
                                                                onclick="event.preventDefault(); confirmDelete({{ $plant->id }})">
                                                            Hapus
                                                        </button>
                                                    </form>
                        
                                                    <!-- Link untuk Edit -->
                                                    <a href="{{ route('admin.editPlant', $plant->id) }}"
                                                       class="bg-blue-500 text-white font-medium text-center px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:underline">
                                                        Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        </table>
                    </div>

                    {{-- Add Plant Form --}}
                    <form action="{{ route('addPlant') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tambah Tanaman Baru</label>
                            <input type="text" name="name" required
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-8 py-4 rounded-md text-base hover:bg-green-700 transition duration-300">
                                Tambah Tanaman
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Formula Management --}}
                <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b">Manajemen Formula</h2>
                    
                    {{-- Formula List --}}
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full divide-y divide-gray-300 border-l border-r border-b border-gray-300 rounded-lg overflow-hidden shadow-lg">
                            {{-- Original formula table content --}}
                            <thead class="bg-greenSecondary text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">ID</th>
                                    <th class="px-4 py-3 text-left font-semibold">Tanaman</th>
                                    <th class="px-4 py-3 text-left font-semibold">Pestisida</th>
                                    <th class="px-4 py-3 text-left font-semibold">Dosis (ml/m²)</th>
                                    <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">
                                @foreach($dosages as $dosage)
                                <tr class="hover:bg-gray-100 transition duration-150">
                                    <td class="px-4 py-2 font-medium text-gray-700 border-r">{{ $dosage->id }}</td>
                                    <td class="px-4 py-2 text-gray-600 border-r">{{ $dosage->plant->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-gray-600 border-r">{{ $dosage->pesticide->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-gray-600 border-r">{{ $dosage->dosage_per_hectare }}</td>
                                    <td class="px-4 py-2 text-gray-600 flex space-x-4">
                                        <div class="flex-grow space-x-2">
                                            <form action="{{ route('admin.deleteDosage', $dosage->id) }}" method="POST" style="display:inline;" id="delete-dosage-form-{{ $dosage->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="bg-red-500 rounded-md text-white font-medium px-4 py-2 hover:bg-red-700 focus:outline-none focus:underline" 
                                                    onclick="confirmDelete({{ $dosage->id }})">Hapus</button>
                                            </form>
                                            <a href="{{ route('admin.editDosage', $dosage->id) }}" class="bg-blue-500 text-white font-medium rounded-md px-4 py-2 hover:bg-blue-700 focus:outline-none focus:underline">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Add Formula Form --}}
                    <form action="{{ route('addDosage') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pestisida</label>
                                <select name="pesticide_id" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                    <option value="" disabled selected>Pilih Pestisida</option>
                                    @foreach($pesticides as $pesticide)
                                    <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanaman</label>
                                <select name="plant_id" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                    <option value="" disabled selected>Pilih Tanaman</option>
                                    @foreach($plants as $plant)
                                    <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Dosis (ml/m<sup>2</sup>)</label>
                                <input type="number" name="dosage_per_hectare" required step="0.01"
                                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-8 py-4 rounded-md text-base hover:bg-green-700 transition duration-300">
                                Tambah Formula
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data ini dan data lain yang terkait akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-dosage-form-' + id).submit();
            }
        });
    }
</script>
@endsection
