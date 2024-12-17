@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Pengguna')
@section('content')
<div class="ml-64 flex-1 mt-[4.5rem]">
    <section class="p-4">
        <div class="container ml-6">
            <nav class="text-lg">
                <ol class="list-reset flex text-gray-600">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-green-500 hover:text-green-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Kelola Pengguna</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="p-8">
        <div class="container">
            <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Pengguna</h1>
            <p class="text-gray-600 mt-2 lg:text-lg">Lihat dan kelola data pengguna di platform Anda</p>
        </div>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Pengguna
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border text-center">Nama</th>
                            <th class="px-4 py-2 border text-center">Email</th>
                            <th class="px-4 py-2 border text-center">Role</th>
                            <th class="px-4 py-2 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-2 border text-gray-800">{{ $user->email }}</td>
                                <td class="px-4 py-2 border text-gray-800 capitalize">{{ $user->getRoleNames() }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <button type="button" 
                                        onclick="confirmDelete('{{ route('admin.delete-user', $user->user_id) }}')" 
                                        class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada pengguna terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    function confirmDelete(actionUrl) {
        Swal.fire({
            title: 'Hapus Pengguna',
            text: 'Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = actionUrl;

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection