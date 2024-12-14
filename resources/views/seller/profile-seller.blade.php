@extends('components.template')
@section('title', 'Edit Profil')
@section('content')

<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        {{-- Profile Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Biodata Diri</h1>
            <p class="text-gray-600">Edit dan perbarui informasi profil Anda</p>
        </div>

        {{-- Profile Form --}}
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Store Name --}}
                    <div>
                        <label for="store_name" class="block text-base font-medium text-gray-700">Nama Toko</label>
                        <p class="text-xl font-medium text-gray-900">{{ $user->store->name }}</p>
                        <input type="hidden" name="store_name" id="store_name" value="{{ $user->store->name }}">
                    </div>

                    {{-- Divider --}}
                    <div class="col-span-1 md:col-span-2">
                        <hr class="border-gray-300">
                    </div>

                    {{-- Seller Name --}}
                    <div>
                        <label for="name" class="block text-base font-medium text-gray-700">Nama Penjual</label>
                        <p class="text-xl font-medium text-gray-900">{{ $user->name }}</p>
                    </div>

                     {{-- Email --}}
                     <div>
                        <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                        <p class="text-xl font-medium text-gray-900">{{ $user->email ?? '-' }}</p>
                    </div>

                    {{-- Divider --}}
                    <div class="col-span-1 md:col-span-2">
                        <hr class="border-gray-300">
                    </div>

                    {{-- Username --}}
                    <div>
                        <label for="email" class="block text-base font-medium text-gray-700">Username</label>
                        <p class="text-xl font-medium text-gray-900">{{ $user->username ?? '-' }}</p>
                    </div>
                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-base font-medium text-gray-700">Password</label>
                        <p class="text-xl font-medium text-gray-900">{{ str_repeat('●', min(8, strlen($user->password))) }}</p>
                    </div>

                    {{-- Address --}}
                    <div class="col-span-1 md:col-span-2">
                        <label for="address" class="block text-base font-medium text-gray-700">Alamat</label>
                        @if ($addresses->isEmpty())
                            <p class="text-xl font-medium text-gray-900">-</p>
                            <div class="text-right mb-4">
                                <button type="button" id="add-address-btn"
                                    class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                    Tambah Alamat
                                </button>
                            </div>
                        @else
                            @foreach ($addresses as $address)
                                <p class="text-xl font-medium text-gray-900">{{ $address->getFullAddressAttribute() ?? '-' }}</p>
                            @endforeach
                        @endif
                    </div>

                </div>
                <div class="text-right mt-2">
                    <button type="submit"
                        class="px-6 py-3 bg-greenSecondary text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Edit Profil
                    </button>
                </div>
        </div>

        {{-- Add New Address Card (Hidden by Default) --}}
        <div id="add-address-form" class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100 hidden">
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

            <form action="{{ route('seller.address.save') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Province --}}
                    <div>
                        <label for="province" class="block text-base font-medium text-gray-700 mb-2">Provinsi</label>
                        <select id="province" name="province"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province['province_id'] }}" data-province="{{ $province['province'] }}">{{ $province['province'] }}</option>
                            @endforeach
                        </select>
                        @error('province')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="province_name" id="province_name">
                    </div>

                    {{-- City --}}
                    <div>
                        <label for="city" class="block text-base font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                        <select id="city" name="city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                        </select>
                        @error('city')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="city_name" id="city_name">
                    </div>
                    {{-- Street Address --}}
                    <div>
                        <label for="detail_address" class="block text-base font-medium text-gray-700 mb-2">Alamat
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

        {{-- Back Button --}}
        <div class="text-left mt-8">
            <button onclick="window.history.back()"
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                Kembali
            </button>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-address-btn').addEventListener('click', function () {
        document.getElementById('add-address-form').classList.toggle('hidden');
    });

    document.getElementById('province').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const provinceId = selectedOption.value;
        const provinceName = selectedOption.getAttribute('data-province');

        document.getElementById('province_name').value = provinceName;

        fetch(`/api/cities?province_id=${provinceId}`)
            .then(response => response.json())
            .then(data => {
                const citySelect = document.getElementById('city');
                citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>'; // Reset options

                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.city_id}" data-city="${city.city_name}">${city.city_name}</option>`;
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    });

    document.getElementById('city').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const cityName = selectedOption.getAttribute('data-city');

        document.getElementById('city_name').value = cityName;
    });
</script>

@endsection