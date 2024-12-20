@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Kalkulasi Pestisida')
@section('content')
<div class="ml-56 flex-1">
    <section class="bg-gradient-to-r from-green-600 to-green-700 p-8 text-center mt-16">
        <h1 class="text-2xl font-bold text-white lg:text-5xl">Kalkulasi Kebutuhan Pestisida</h1>
        <p class="text-gray-100 mt-4 lg:text-xl">Kelola kalkulasi pestisida untuk mengurangi pencemaran lingkungan</p>
    </section>

    <div class="container mx-auto px-4 py-8 w-full">
        <div class="flex justify-center space-x-6">
            <div class="w-1/2 bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b">Kalkulator Pestisida</h2>
                <form class="space-y-6" id="pesticide-form">
                    <div class="space-y-4">
                        <div>
                            <label for="pestisida" class="block text-sm font-medium text-gray-700">Nama
                                Pestisida</label>
                            <select id="pestisida_select" required
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                <option value="" disabled selected>Pilih Pestisida</option>
                                @foreach($pesticides as $pesticide)
                                <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanaman</label>
                            <select id="selected_tanaman" name="plant_id" required
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                <option value="" disabled selected>Pilih Tanaman</option>
                                @foreach($plants as $plant)
                                <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="land_area" class="block text-sm font-medium text-gray-700">Luas Lahan
                                (m<sup>2</sup>)</label>
                            <input type="text" id="land_area_value" name="luas_lahan" required
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>

                        <div>
                            <input type="hidden" id="dosage" required min="0" step="0.1" readonly
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                                placeholder="Dosis">
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

            <div class="w-1/2 bg-white shadow-lg rounded-lg p-6 border border-gray-200">
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
    });

    $('#selected_tanaman').on('change', function () {
        const selectedDose = $(this).find('option:selected').data('dose');
        $('#dosage').val(selectedDose || '');
    });

    document.getElementById('land_area_value').addEventListener('input', function (e) {
        if (e.target.value < 0 || e.target.value.includes('-')) {
            e.target.value = '';
        }
    });

    $('#land_area_value').on('input', function () {
        const landArea = parseFloat($(this).val());
        if (isNaN(landArea) || landArea <= 0) {
        $('#land_area_error').text('Luas lahan harus lebih dari 0 dan tidak boleh kosong.').removeClass('hidden');
        } else {
        $('#land_area_error').addClass('hidden');
        }
    });

    $('#calculate-btn').on('click', function () {
        const landArea = parseFloat($('#land_area_value').val());
        const dosage = parseFloat($('#dosage').val());
        const pesticideName = $('#pestisida_select option:selected').text();

        if (!$('#pestisida_select').val() || !$('#selected_tanaman').val()) {
            alert('Pilih pestisida dan tanaman terlebih dahulu.');
            return;
        }

        if (isNaN(landArea) || isNaN(dosage)) {
            alert('Masukkan nilai valid untuk luas lahan dan dosis.');
            $('#land_area_value, #dosage').addClass('border-red-500');
            return;
        } else {
            $('#land_area_value, #dosage').removeClass('border-red-500');
        }

        const totalPesticide = landArea * dosage;
        const totalWater = landArea / 4;

        $('#pesticide-name').text(pesticideName);
        $('#land-area').text(landArea.toFixed(2));
        $('#dosage-value').text(dosage.toFixed(2));
        $('#total-pesticide').text(totalPesticide.toFixed(2));
        $('#water-value').text(totalWater.toFixed(2));
    });
</script>
@endsection