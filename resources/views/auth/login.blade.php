@extends('components.template')
@section('title', 'Login')
@section('content')
<div class="flex justify-center items-center min-h-screen bg-green-50">
    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg border border-green-200">
        <h2 class="text-2xl font-semibold text-center text-green-600 mb-6">Login</h2>

        @if(session('success'))
        <p class="alert alert-success text-green-600">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger text-red-600">{{ $err }}</p>
        @endforeach
        @endif

        <form action="{{ route('landing') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username <span class="text-red-500">*</span></label>
                <input id="username" class="form-input mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" type="text" name="username" value="{{ old('username') }}" required />
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                <input id="password" class="form-input mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" type="password" name="password" required />
            </div>

            <div class="flex justify-between items-center">
                <button class="w-full py-2 px-4 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 mx-1" type="submit">Login</button>
                <a class="w-full text-center py-2 px-4 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 mx-1" href="{{ route('landing') }}">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
