<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <nav class="bg-blue-500 p-4 text-white rounded">
            <ul class="flex space-x-4">
                <li><a href="{{ route('carros.index') }}" class="hover:underline">Carros</a></li>
                <li><a href="{{ route('carros.create') }}" class="hover:underline">Agregar Carro</a></li>
            </ul>
        </nav>

        <div class="mt-6">
            @yield('content')
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>
