@extends('components.template')
@include('components.sidebarAdmin')

@section('title', 'Deteksi Penyakit Tanaman')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl mx-auto p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Upload Foto untuk Deteksi</h1>

        <form action="{{ route('user.detect.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Pilih Gambar</label>
                <input type="file" name="image" id="image"
                       class="mt-2 block w-full text-sm rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 @error('image') border-red-500 @enderror"
                       onchange="previewImage()" required>
                @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <img id="imagePreview" src="" alt="Preview Gambar" class="hidden w-full rounded-lg border" />
            </div>

            <button type="submit"
                    class="w-full py-3 px-6 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                Upload dan Deteksi
            </button>
        </form>

        @if(session('result'))
            <div class="mt-8 p-6 bg-green-100 border border-green-500 rounded-lg">
                <h2 class="text-lg font-semibold">Hasil Deteksi</h2>
                <ul class="mt-3 space-y-2">
                    @foreach (session('result')['class_name'] as $class)
                        <li>{{ $class }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($errors->any())
        <div class="mt-8 p-6 bg-red-100 border border-red-500 rounded-lg">
            <ul class="text-red-700 text-sm space-y-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

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