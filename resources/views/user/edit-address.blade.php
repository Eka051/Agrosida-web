@extends('components.template')
@section('title', 'Edit Alamat')
@section('content')
<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        {{-- Edit Address Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Edit Alamat</h1>
            <p class="text-gray-600">Perbarui alamat pengiriman dan penagihan Anda</p>
        </div>

        {{-- Edit Address Card --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Perbarui Alamat</h2>
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

            <form action="{{ route('user.address.update', $address->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Recipient Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $address->name) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan nama penerima">
                        @error('name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Province --}}
                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <select id="province" name="province"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled>Pilih Provinsi</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province['province_id'] }}" data-province="{{ $province['province'] }}"
                                {{ $address->province_id == $province['province_id'] ? 'selected' : '' }}>
                                {{ $province['province'] }}
                            </option>
                            @endforeach
                        </select>
                        @error('province')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="province_name" id="province_name" value="{{ $address->province->province_name }}">
                    </div>

                    {{-- City --}}
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                        <select id="city" name="city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled>Pilih Kota/Kabupaten</option>
                            @foreach($cities as $city)
                            <option value="{{ $city['city_id'] }}" data-city="{{ $city['city_name'] }}"
                                {{ $address->city_id == $city['city_id'] ? 'selected' : '' }}>
                                {{ $city['city_name'] }}
                            </option>
                            @endforeach
                        </select>
                        @error('city')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="city_name" id="city_name" value="{{ $address->city->city_name }}">
                    </div>

                    {{-- Street Address --}}
                    <div>
                        <label for="detail_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                            Lengkap</label>
                        <textarea id="detail_address" name="detail_address" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan alamat lengkap">{{ old('detail_address', $address->detail_address) }}</textarea>
                        @error('detail_address')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Perbarui Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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