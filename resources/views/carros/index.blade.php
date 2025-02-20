@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto mt-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Vehículos</h1>

    <form action="{{ route('carros.index') }}" method="GET" class="mb-6">
        <input
            type="text"
            name="search"
            placeholder="Buscar por marca o modelo"
            value="{{ request('search') }}"
            class="border p-2 rounded w-full md:w-1/3">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2 md:mt-0 md:ml-2">Buscar</button>

        @if(request('search'))
        <a href="{{ route('carros.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mt-2 md:mt-0 md:ml-2">Limpiar Filtro</a>
        @endif
    </form>

    <a href="{{ route('carros.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        + Agregar Vehículo
    </a>

    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Marca</th>
                    <th class="p-3 text-left">Modelo</th>
                    <th class="p-3 text-left">Año</th>
                    <th class="p-3 text-left">Color</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if($carros->isEmpty())
                <tr>
                    <td colspan="6" class="p-3 text-center text-red-500">No se encontraron resultados para "{{ request('search') }}"</td>
                </tr>
                @else
                @foreach($carros as $carro)
                <tr class="border-t">
                    <td class="p-3">{{ $carro->marca }}</td>
                    <td class="p-3">{{ $carro->modelo }}</td>
                    <td class="p-3">{{ $carro->año }}</td>
                    <td class="p-3">{{ $carro->color }}</td>
                    <td class="p-3">${{ number_format($carro->precio, 2) }}</td>
                    <td class="p-3">
                        <a href="{{ route('carros.edit', $carro) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            <i class="fas fa-edit mr-2"></i> Editar
                        </a>
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 delete-carro" data-id="{{ $carro->id }}">
                            <i class="fas fa-trash mr-2"></i> Eliminar
                        </button>
                        <form id="delete-form-{{ $carro->id }}" action="{{ route('carros.destroy', $carro) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $carros->links() }}
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".delete-carro");

        buttons.forEach(button => {
            button.addEventListener("click", function() {
                const carroId = this.getAttribute("data-id");
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${carroId}`).submit();
                    }
                });
            });
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
            });
        @endif

        @if($carros->isEmpty() && request('search'))
            Swal.fire({
                icon: 'info',
                title: 'No se encontraron resultados',
                text: 'No hay carros que coincidan con tu búsqueda.',
            });
        @endif
    });
</script>

@endsection