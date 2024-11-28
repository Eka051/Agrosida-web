@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Pengguna')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Pengguna</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Lihat dan kelola data pengguna di platform Anda</p>
    </section>

    <!-- Tabel Pengguna -->
    <section class="py-8">
        <div class="mx-4 bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Pengguna
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Role</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Statis Pengguna -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">1</td>
                            <td class="px-4 py-2 border text-gray-800">John Doe</td>
                            <td class="px-4 py-2 border text-gray-800">johndoe@example.com</td>
                            <td class="px-4 py-2 border text-gray-800 capitalize">admin</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="px-2 py-1 text-sm rounded-lg bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <button typr="button" 
                                       class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-yellow-600" onclick="window.location.href='{{route('admin.editpengguna')}}'">
                                        Edit
                                    </button>
                                    <button type="button" 
                                            class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">2</td>
                            <td class="px-4 py-2 border text-gray-800">Jane Smith</td>
                            <td class="px-4 py-2 border text-gray-800">janesmith@example.com</td>
                            <td class="px-4 py-2 border text-gray-800 capitalize">user</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="px-2 py-1 text-sm rounded-lg bg-red-100 text-red-700">
                                    Nonaktif
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <button typr="button" 
                                       class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-yellow-600" onclick="window.location.href='{{route('admin.editpengguna')}}'">
                                        Edit
                                    </button>
                                    <button type="button" 
                                            class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600" onclick="window.location.href='{{route('admin.editpengguna')}}'">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Jika tidak ada pengguna -->
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada pengguna terdaftar.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
