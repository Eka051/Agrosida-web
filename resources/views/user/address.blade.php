@extends('components.template')
@section('title', 'Kelola Alamat')
@section('content')
<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        {{-- Address Management Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Manajemen Alamat</h1>
            <p class="text-gray-600">Atur dan kelola alamat pengiriman dan penagihan Anda</p>
        </div>

        {{-- Add New Address Card --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Tambah Alamat Baru</h2>
                <span class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
            </div>

            <form action="{{ route('user.address.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Recipient Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan nama penerima">
                        @error('name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Province --}}
                    <div>
                        <label for="province_id" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <select id="province_id" name="province_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province['province_id'] }}" {{
                                old('province_id')==$province['province_id'] ? 'selected' : '' }}>
                                {{ $province['province'] }}
                            </option>
                            @endforeach
                        </select>
                        @error('province')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                        <select id="city" name="city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                            @foreach($cities as $city)
                            <option value="{{ $city['city_id'] }}" {{ old('city')==$city['city_id'] ? 'selected' : ''
                                }}>
                                {{ $city['city_name'] }}
                            </option>
                            @endforeach
                        </select>
                        @error('city')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Street Address --}}
                    <div>
                        <label for="detail_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                            Lengkap</label>
                        <textarea id="detail_address" name="detail_address" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan alamat lengkap">{{ old('detail_address') }}</textarea>
                        @error('detail_address')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Simpan Alamat
                    </button>
                </div>
            </form>
        </div>

        {{-- Saved Addresses --}}
        <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Alamat Tersimpan</h2>
                <span class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </span>
            </div>

            @if($addresses->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <p class="text-lg">Anda belum memiliki alamat tersimpan</p>
                <p class="text-sm">Tambahkan alamat baru untuk memulai</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($addresses as $address)
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-300 hover:shadow-lg transition duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">{{ $address->name }}</h3>
                            <p class="text-sm text-gray-700">{{ $address->detail_address }}</p>
                            <p class="text-sm text-gray-700">{{ $address->city->city_name }}, {{
                                $address->province->province_name }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('user.address.edit', $address->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('user.address.delete', $address->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const provinceSelect = document.getElementById('province_id');
    const citySelect = document.getElementById('city');

    provinceSelect.addEventListener('change', async () => {
        const provinceId = provinceSelect.value;

        citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';

        if (provinceId) {
            try {
                const response = await fetch(`/get-cities?province_id=${provinceId}`);
                const data = await response.json();

                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.city_id;
                    option.textContent = city.city_name;
                    citySelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }
    });
});

</script>
@endsection