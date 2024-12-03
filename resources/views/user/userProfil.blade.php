@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Profil')
@section('content')
<div class="ml-56 flex-1">
    <!-- Header Section -->
    <section class="bg-primaryBg p-8 text-center mt-20 lg:mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Profil User</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Lihat dan kelola informasi profil Anda di sini</p>
    </section>

    <!-- Profile Card Section -->
    <section class="py-8 mx-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 flex flex-col lg:flex-row items-center lg:items-start">
            <!-- Profile Picture -->
            <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full bg-gray-200 flex-shrink-0 overflow-hidden">
                <img src="https://via.placeholder.com/150" alt="User Picture" class="w-full h-full object-cover">
            </div>
            <!-- Profile Details -->
            <div class="flex-1 lg:ml-6 mt-6 lg:mt-0">
                <h2 class="text-xl font-bold text-gray-800">Nama Lengkap</h2>
                <p class="text-gray-600 mt-1">John Doe</p>
                
                <h2 class="text-xl font-bold text-gray-800 mt-4">Email</h2>
                <p class="text-gray-600 mt-1">johndoe@example.com</p>
                
                <h2 class="text-xl font-bold text-gray-800 mt-4">No. Telepon</h2>
                <p class="text-gray-600 mt-1">+62 812 3456 7890</p>
                
                <h2 class="text-xl font-bold text-gray-800 mt-4">Alamat</h2>
                <p class="text-gray-600 mt-1">Jalan Mawar No. 123, Jakarta, Indonesia</p>
            
                <!-- Edit Profile Button -->
                <a href="{{route('user.profiledit')}}" class="mt-6 block px-4 py-2 bg-green-500 text-white font-medium rounded-md hover:bg-green-600 transition w-32 text-center">
                    Edit Profil
                </a>
            </div>    
        </div>
    </section>
</div>
@endsection
