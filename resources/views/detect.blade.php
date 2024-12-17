@extends('components.template')
@include('components.sidebarAdmin')

@section('title', 'Deteksi Penyakit Tanaman')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow-md">
        <h1 class="text-2xl font-bold text-center mb-4">Upload Foto untuk Deteksi</h1>

        <!-- Form Upload -->
        <form action="{{ route('detect.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Pilih Gambar</label>
                <input type="file" name="image" id="image"
                       class="mt-1 block w-full text-sm border rounded-md shadow-sm @error('image') border-red-500 @enderror"
                       onchange="previewImage()" required>
                @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Preview Gambar -->
            <div class="mt-4">
                <img id="imagePreview" src="" alt="Preview Gambar" class="hidden w-full rounded-md border" />
            </div>

            <button type="submit"
                    class="w-full py-2 px-4 bg-Green-600 text-white rounded-md hover:bg-green-700">
                Upload dan Deteksi
            </button>
        </form>

        <!-- Menampilkan Hasil Deteksi -->
        @if(session('result'))
            <div class="mt-6 p-4 bg-green-100 border border-green-500 rounded">
                <h2 class="text-lg font-semibold">Hasil Deteksi</h2>
                <ul class="mt-2 space-y-1">
                    @foreach (session('result')['class_name'] as $class)
                        <li>{{ $class }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Menampilkan Error -->
        @if($errors->any())
        <div class="mt-6 p-4 bg-red-100 border border-red-500 rounded">
            <ul class="text-red-700 text-sm space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<!-- Tambahkan Script -->
<script>
    function previewImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('imagePreview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    }
</script>
@endsection