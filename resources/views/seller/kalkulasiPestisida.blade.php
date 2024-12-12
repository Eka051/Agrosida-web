@extends('components.template')
@section('title', 'Kalkulasi Pestisida')
@include('components.sidebarSeller')
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
</div>

@endsection
