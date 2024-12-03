@extends('components.template')
@include('components.sidebarSeller') 
@section('title', 'Profil Seller')
@section('content')
<div class="ml-56 flex-1">
    <!-- Header Section -->
    <section class="bg-primaryBg p-8 text-center mt-20 lg:mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Profil Seller</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola informasi profil bisnis Anda di sini</p>
    </section>

    <!-- Profile Card Section -->
    <section class="py-8 mx-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 flex flex-col lg:flex-row items-center lg:items-start">
            <!-- Profile Picture -->
            <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full bg-gray-200 flex-shrink-0 overflow-hidden">
                <img src="https://via.placeholder.com/150" alt="Seller Picture" class="w-full h-full object-cover">
            </div>
            <!-- Profile Details -->
            <div class="flex flex-col lg:ml-6 mt-6 lg:mt-0">
                <h2 class="text-xl font-bold text-gray-800">Nama Seller</h2>
                <p class="text-gray-600 mt-1">Agro Tani</p>
                
                <h2 class="text-xl font-bold text-gray-800 mt-4">Email</h2>
                <p class="text-gray-600 mt-1">agrotani@example.com</p>
                
                <h2 class="text-xl font-bold text-gray-800 mt-4">No. Telepon</h2>
                <p class="text-gray-600 mt-1">+62 812 9876 5432</p>
                
                <h2 class="text-xl font-bold text-gray-800 mt-4">Alamat Bisnis</h2>
                <p class="text-gray-600 mt-1">Jalan Melati No. 456, Bandung, Indonesia</p>
                
                <h2 class="text-xl font-bold text-gray-800 mt-4">Deskripsi Toko</h2>
                <p class="text-gray-600 mt-1">Kami menyediakan pestisida berkualitas untuk kebutuhan pertanian Anda dengan harga bersaing.</p>
            
                <!-- Edit Profile Button -->
                <a href="{{route('seller.editprofil')}}" class="mt-6 px-4 py-2 bg-green-500 text-white font-medium rounded-md hover:bg-green-600 transition w-32 text-center">
                    Edit Profil
                </a>
            </div>
        </div>
    </section>
</div>
@endsection