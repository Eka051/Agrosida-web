@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Edit Tanaman')
@section('content')

<div class="max-w-lg mx-auto mt-20 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Tanaman</h2>

    <form action="{{ route('admin.updateDosage', $dosage->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="mb-5">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama</label>
            <input
                type="text"
                name="dosage_per_hectare"
                id="dosage_per_hectare"
                value="{{ $dosage->dosage_per_hectare }}"
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ketik Dosis"
            >
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full py-3 mt-6 text-white bg-blue-500 rounded-lg font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200"
        >
            Submit
        </button>
    </button>
    </form>
</div>
@endsection