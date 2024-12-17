@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Kalkulasi Pestisida')
@section('content')
<div class="ml-64 mt-16 flex-1">
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
                        <select id="pestisida_select" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="" disabled selected>Pilih Pestisida</option>
                            @foreach($pesticides as $pesticide)
                            <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanaman" class="block text-sm font-medium text-gray-700">Nama Tanaman</label>
                        <select id="selected_tanaman" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="" disabled selected>Jenis Tanaman</option>
                        </select>
                    </div>

                    <div>
                        <label for="land_area" class="block text-sm font-medium text-gray-700">Luas Lahan (m<sup>2</sup>)</label>
                        <input type="text" id="land_area_value" name="luas_lahan" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label for="dosage" class="block text-sm font-medium text-gray-700">Dosis (ml/m<sup>2</sup>)</label>
                        <input type="number" id="dosage" required min="0" step="0.1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" id="calculate-btn"
                        class="bg-green-600 text-white px-6 py-2 rounded-md text-sm hover:bg-green-700 transition duration-300">
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
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Nama Pestisida</p>
                        <p class="font-medium text-gray-900" id="pesticide-name">-</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Luas Lahan</p>
                        <p class="font-medium text-gray-900"><span id="land-area">-</span> m<sup>2</sup></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Dosis</p>
                        <p class="font-medium text-gray-900"><span id="dosage-value">-</span> ml/m<sup>2</sup></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Total Kebutuhan Pestisida</p>
                        <p class="font-medium text-gray-900"><span id="total-pesticide">-</span> ml</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg col-span-2">
                        <p class="text-sm text-gray-600">Total Kebutuhan Air</p>
                        <p class="font-medium text-gray-900"><span id="water-value">-</span> liter</p>
                    </div>
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
</script>
@endsection
