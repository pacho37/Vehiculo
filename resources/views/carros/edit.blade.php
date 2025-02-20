@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Carro</h1>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Actualización exitosa!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <form action="{{ route('carros.update', $carro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Marca</label>
            <input type="text" name="marca" class="w-full p-2 border rounded @error('marca') border-red-500 @enderror" value="{{ old('marca', $carro->marca) }}">
            @error('marca')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Modelo</label>
            <input type="text" name="modelo" class="w-full p-2 border rounded @error('modelo') border-red-500 @enderror" value="{{ old('modelo', $carro->modelo) }}">
            @error('modelo')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Año</label>
            <input type="number" name="año" class="w-full p-2 border rounded @error('año') border-red-500 @enderror" value="{{ old('año', $carro->año) }}">
            @error('año')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Color</label>
            <input type="text" name="color" class="w-full p-2 border rounded @error('color') border-red-500 @enderror" value="{{ old('color', $carro->color) }}">
            @error('color')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Precio</label>
            <input type="text" name="precio" class="w-full p-2 border rounded @error('precio') border-red-500 @enderror" value="{{ old('precio', $carro->precio) }}">
            @error('precio')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar</button>
    </form>
</div>
@endsection
