@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Pengguna')
@section('content')
<div class="ml-56 flex-1">
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Pengguna</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Lihat dan kelola data pengguna di platform Anda</p>
    </section>

    <section class="py-8">
        <div class="mx-4 bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Pengguna
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Role</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-2 border text-gray-800">{{ $user->email }}</td>
                                <td class="px-4 py-2 border text-gray-800 capitalize">{{ $user->getRoleNames() }}</td>
                                <td class="px-4 py-2 border">
                                    <button onclick="showModal('{{ route('admin.delete-user', ['user_id' => $user->user_id]) }}')"
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

<div id="deleteModal" class="fixed inset-0 z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-2xl font-semibold text-gray-900" id="modal-title">Hapus Pengguna</h3>
                            <div class="mt-2">
                                <p class="text-lg text-gray-500">Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 px-6 py-4 flex flex-col">
                    <form id="deleteForm" action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full justify-center rounded-md bg-red-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-red-500">
                            Hapus
                        </button>
                    </form>
                    <button type="button" onclick="hideModal()" class="w-full justify-center rounded-md bg-white px-6 py-3 text-lg font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    </script>
@endif

<script>
    function showModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = actionUrl;
        modal.classList.remove('hidden');
    }

    function hideModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }
</script>
@endsection