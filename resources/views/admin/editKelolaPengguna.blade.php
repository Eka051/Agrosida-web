@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Edit Pengguna')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Edit Pengguna</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Perbarui informasi pengguna di platform Anda</p>
    </section>

    <!-- Form Edit Pengguna -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="#" method="POST" class="space-y-6">
                <!-- ID Pengguna -->
                <div>
                    <label for="id_pengguna" class="block text-xl font-medium text-gray-700">ID Pengguna</label>
                    <input type="text" id="id_pengguna" name="id_pengguna" readonly 
                        value="1" 
                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Nama Pengguna -->
                <div>
                    <label for="nama_pengguna" class="block text-xl font-medium text-gray-700">Nama Pengguna</label>
                    <input type="text" id="nama_pengguna" name="nama_pengguna" required
                        value="John Doe"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Email Pengguna -->
                <div>
                    <label for="email_pengguna" class="block text-xl font-medium text-gray-700">Email</label>
                    <input type="email" id="email_pengguna" name="email_pengguna" required
                        value="johndoe@example.com"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Role Pengguna -->
                <div>
                    <label for="role_pengguna" class="block text-xl font-medium text-gray-700">Role</label>
                    <select id="role_pengguna" name="role_pengguna" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="Admin" selected>Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>

                <!-- Status Pengguna -->
                <div>
                    <label for="status_pengguna" class="block text-xl font-medium text-gray-700">Status</label>
                    <select id="status_pengguna" name="status_pengguna" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="Aktif" selected>Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <a href="/admin/kelola-pengguna" 
                        class="bg-gray-500 text-white px-6 py-2 rounded-md text-sm mr-4 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Batal
                    </a>
                    <button type="submit" 
                        class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
