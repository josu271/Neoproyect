<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @stack('head')  {{-- espacio para estilos/scripts adicionales en <head> --}}
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">{{ config('app.name') }}</">
                    {{ config('app.name') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Cerrar sesión</">
                    Cerrar sesión
                  </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    {{-- Aquí inyectamos modales definidos en vistas individuales --}}
    @stack('modals')

    {{-- Scripts adicionales bajo demanda --}}
    @stack('scripts')
</body>
</html>