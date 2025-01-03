@extends('components.template')
@section('title', 'Kelola Alamat')
@section('content')
<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Manajemen Alamat</h1>
            <p class="text-gray-600">Atur dan kelola alamat pengiriman dan penagihan Anda</p>
        </div>

        <div class="text-right mb-4">
            <button id="add-address-btn"
                class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                Tambah Alamat
            </button>
        </div>

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

            <form action="{{ route('user.address.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-base font-medium text-gray-700 mb-2">Nama Penerima</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan nama penerima">
                        @error('name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-base font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="number" id="phone_number" name="phone_number" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan nomor telepon">
                        @error('phone')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

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
                <p class="text-sm">Tambahkan alamat baru untuk pengiriman</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($addresses as $address)
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-300 hover:shadow-lg transition duration-300">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $address->name }}</h3>
                        <h3 class="text-base text-gray-900">{{ $address->phone_number }}</h3>
                        <p class="text-base text-gray-700">{{ $address->detail_address }}</p>
                        <p class="text-base text-gray-700">{{ $address->city->city_name }}, {{
                            $address->province->province_name }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('user.address.edit', $address->id) }}"
                            class="px-6 py-2 bg-gray-100 border border-gray-300 text-gray-600 rounded-lg hover:bg-greenPrimary hover:text-white transition duration-300">Edit</a>
                        <form action="{{ route('user.address.delete', $address->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="text-left mt-8">
            <button onclick="window.history.back()"
            class="px-8 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
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
            citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';

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

        function saveProductDetails() {
        var productDetails = {
            productId: document.querySelector('input[name="product_id"]').value,
            quantity: document.getElementById('quantity').value
        }
        sessionStorage.setItem('productDetails', JSON.stringify(productDetails));
        }

        function saveProductDetailsAndGoBack() {
        saveProductDetails();
        const productId = document.querySelector('input[name="product_id"]').value;
        window.location.href = "{{ route('user.order', '') }}/" + productId;
        }
    </script>

@endsection
