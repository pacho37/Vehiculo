@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Agregar Nuevo Carro</h1>
    
    <form action="{{ route('carros.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="marca" class="block text-gray-700">Marca</label>
            <input type="text" name="marca" id="marca" class="w-full p-2 border rounded @error('marca') border-red-500 @enderror" value="{{ old('marca') }}">
            @error('marca')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="modelo" class="block text-gray-700">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="w-full p-2 border rounded @error('modelo') border-red-500 @enderror" value="{{ old('modelo') }}">
            @error('modelo')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="año" class="block text-gray-700">Año</label>
            <input type="number" name="año" id="año" class="w-full p-2 border rounded @error('año') border-red-500 @enderror" value="{{ old('año') }}">
            @error('año')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="color" class="block text-gray-700">Color</label>
            <input type="text" name="color" id="color" class="w-full p-2 border rounded @error('color') border-red-500 @enderror" value="{{ old('color') }}">
            @error('color')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-gray-700">Precio</label>
            <input type="text" name="precio" id="precio" class="w-full p-2 border rounded @error('precio') border-red-500 @enderror" value="{{ old('precio') }}">
            @error('precio')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
    </form>
</div>
@endsection
