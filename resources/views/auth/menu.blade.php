@extends('layouts.app')

@section('title', 'Menú Principal')

@section('content')
    <div class="container mx-auto py-12 px-4">
        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-10">Menú Principal</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @php
                $opciones = [
                    ['url' => route('clientes.index'),      'nombre' => 'Clientes',           'icono' => '👤'],
                    ['url' => route('pago.index'), 'nombre' => 'Pago', 'icono' => '💵'],
                    /*['url' => route('facturacion.masiva'),      'nombre' => 'Facturacion masiva',   'icono' => '📄'],*/
                    /*['url' => route('cobranzas.index'),    'nombre' => 'Cobranzas',          'icono' => '💰'],*/
                    /*['url' => route('servicio.masivo'),    'nombre' => 'Servicio Masivo',    'icono' => '🗂️'],*/
                    ['url' => route('empleados.index'),     'nombre' => 'Empleados', 'icono' => '🛠️'],
                   /* ['url' => route('compras.index'),      'nombre' => 'Perfil',  'icono' => '🛒'],*/
                    /*['url' => route('cierre.caja'),        'nombre' => 'Cierre de Caja',     'icono' => '🧾'],*/
                ];
            @endphp

            @foreach ($opciones as $op)
                <a href="{{ $op['url'] }}"
                   class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center 
                          text-gray-800 hover:shadow-2xl hover:bg-blue-50 transform hover:-translate-y-1 
                          transition-all duration-300 ease-in-out">
                    <div class="text-5xl mb-4">{{ $op['icono'] }}</div>
                    <div class="text-lg font-semibold text-center">{{ $op['nombre'] }}</div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
