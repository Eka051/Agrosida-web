@extends('components.template')
@include('components.sidebarSeller') 

@section('title', 'Edit Profil Seller')

@section('content')
<div class="ml-56 flex-1">
    <!-- Header Section -->
    <section class="bg-primaryBg p-8 text-center mt-20 lg:mt-20">
        <h1 class="text-xl font-bold text-gray-800 lg:text-3xl">Edit Profil Seller</h1>
        <p class="text-gray-700 mt-2 lg:text-lg">Perbarui informasi profil bisnis Anda di sini</p>
    </section>

    <!-- Edit Profile Form Section -->
    <section class="py-8 mx-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('seller.editprofil') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Profile Picture Upload -->
                <div class="flex items-center space-x-6">
                    <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full bg-gray-200 overflow-hidden">
                        <img src="https://via.placeholder.com/150" alt="Current Profile Picture" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <label for="profile_picture" class="block text-lg font-medium text-gray-700">Ganti Foto Profil</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="mt-2 text-lg text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-lg file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>
                </div>

                <!-- Nama Seller -->
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700">Nama Seller</label>
                    <input type="text" id="name" name="name" value="Agro Tani" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-lg">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="agrotani@example.com" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-lg">
                </div>

                <!-- No. Telepon -->
                <div>
                    <label for="phone" class="block text-lg font-medium text-gray-700">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value="+62 812 9876 5432" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-lg">
                </div>

                <!-- Alamat Bisnis -->
                <div>
                    <label for="address" class="block text-lg font-medium text-gray-700">Alamat Bisnis</label>
                    <textarea id="address" name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-lg">Jalan Melati No. 456, Bandung, Indonesia</textarea>
                </div>

                <!-- Deskripsi Toko -->
                <div>
                    <label for="description" class="block text-lg font-medium text-gray-700">Deskripsi Toko</label>
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-lg">Kami menyediakan pestisida berkualitas untuk kebutuhan pertanian Anda dengan harga bersaing.</textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="px-8 py-3 bg-green-500 text-lg text-white font-medium rounded-md hover:bg-green-600 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
