@extends('components.template')
@section('title', 'Alamat')
@section('content')

<div class="container mx-auto p-4 mt-24">
    <h1 class="text-2xl font-bold mb-4">Tambah Alamat</h1>
    <form action="{{ route('user.address.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-gray-600">Nama Penerima</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">
        </div>
        <div>
            <label for="province" class="block text-gray-600">Provinsi</label>
            <select id="province" name="province_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">
                <option value="" disabled selected>Pilih Provinsi</option>
                @foreach($provinces as $province)
                    <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="city" class="block text-gray-600">Kota/Kabupaten</label>
            <select id="city" name="city_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">
                <option value="" disabled selected>Pilih Kota/Kabupaten</option>
            </select>
        </div>
        <div>
            <label for="district" class="block text-gray-600">Kecamatan</label>
            <select id="district" name="district_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">
                <option value="" disabled selected>Pilih Kecamatan</option>
            </select>
        </div>
        <div>
            <label for="village" class="block text-gray-600">Desa/Kelurahan</label>
            <select id="village" name="village_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">
                <option value="" disabled selected>Pilih Desa/Kelurahan</option>
            </select>
        </div>
        <div>
            <label for="street_address" class="block text-gray-600">Alamat Lengkap</label>
            <textarea id="street_address" name="street_address" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">{{ old('street_address') }}</textarea>
        </div>
        <button type="submit" class="w-full bg-green-500 text-white font-medium py-3 rounded-lg hover:bg-green-600">
            Simpan Alamat
        </button>
    </form>
</div>


@push('scripts')
    
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#province').change(function () {
            let provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: `/get-cities/${provinceId}`,
                    type: 'GET',
                    success: function (data) {
                        $('#city').empty().append('<option value="" disabled selected>Pilih Kota/Kabupaten</option>');
                        $('#district').empty().append('<option value="" disabled selected>Pilih Kecamatan</option>');
                        $('#village').empty().append('<option value="" disabled selected>Pilih Desa/Kelurahan</option>');
                        $.each(data, function (index, city) {
                            $('#city').append(`<option value="${city.id}">${city.city_name}</option>`);
                        });
                    },
                    error: function () {
                        alert('Gagal memuat data kota/kabupaten. Coba lagi.');
                    }
                });
            }
        });

        $('#city').change(function () {
            let cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: `/get-districts/${cityId}`,
                    type: 'GET',
                    success: function (data) {
                        $('#district').empty().append('<option value="" disabled selected>Pilih Kecamatan</option>');
                        $('#village').empty().append('<option value="" disabled selected>Pilih Desa/Kelurahan</option>');
                        $.each(data, function (index, district) {
                            $('#district').append(`<option value="${district.id}">${district.district_name}</option>`);
                        });
                    },
                    error: function () {
                        alert('Gagal memuat data kecamatan');
                    }
                });
            }
        });

        $('#district').change(function () {
            let districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: `/get-villages/${districtId}`,
                    type: 'GET',
                    success: function (data) {
                        $('#village').empty().append('<option value="" disabled selected>Pilih Desa/Kelurahan</option>');
                        $.each(data, function (index, village) {
                            $('#village').append(`<option value="${village.id}">${village.village_name}</option>`);
                        });
                    },
                    error: function () {
                        alert('Gagal memuat data desa/kelurahan');
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection
