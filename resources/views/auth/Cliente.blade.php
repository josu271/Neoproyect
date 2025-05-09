@extends('layouts.app')

@section('title','Clientes')

@section('content')
<div class="container mx-auto py-8 px-4" x-data="{ openModal: false }">

  {{-- Header --}}
  <div class="flex items-center justify-between mb-6">
    <a href="{{ route('menu') }}"
       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">← Volver</a>

    <form method="GET" class="flex">
      <input type="text" name="q" value="{{ $q }}"
             class="border rounded-l px-3 py-2"
             placeholder="Buscar DNI o nombre…">
      <button type="submit"
              class="bg-blue-600 text-white px-4 rounded-r hover:bg-blue-700">
        Buscar
      </button>
    </form>

    <button @click="openModal = true"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
      + Añadir
    </button>
  </div>

  {{-- Tabla --}}
  <div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">DNI</th>
          <th class="px-4 py-2">Nombre</th>
          <th class="px-4 py-2">Ap. Paterno</th>
          <th class="px-4 py-2">Ap. Materno</th>
          <th class="px-4 py-2">Teléfono</th>
          <th class="px-4 py-2">Dirección</th>
          <th class="px-4 py-2">Ciudad</th>
          <th class="px-4 py-2">Activo</th>
          <th class="px-4 py-2">Plan</th>
          <th class="px-4 py-2 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($clientes as $c)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $c->DNI }}</td>
          <td class="px-4 py-2">{{ $c->NombreCliente }}</td>
          <td class="px-4 py-2">{{ $c->ApellidopCliente }}</td>
          <td class="px-4 py-2">{{ $c->ApellidomCliente }}</td>
          <td class="px-4 py-2">{{ $c->TelefonoCliente }}</td>
          <td class="px-4 py-2">{{ $c->UbicacionCliente }}</td>
          <td class="px-4 py-2">{{ $c->CiudadCliente }}</td>
          <td class="px-4 py-2">{{ $c->ActivoCliente ? 'Sí' : 'No' }}</td>
          <td class="px-4 py-2">{{ $c->suscripcion->plan->nombrePlan }}</td>
          <td class="px-4 py-2 text-center">
            <a href="{{ route('clientes.edit',$c->idClientes) }}"
               class="text-blue-600 hover:underline">Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="p-4">{{ $clientes->links() }}</div>
  </div>

  {{-- Modal Nuevo Cliente --}}
  <div x-show="openModal"
       class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="openModal = false"
         class="bg-white rounded-lg w-full max-w-lg overflow-hidden">
      <div class="px-6 py-4">
        <h2 class="text-xl font-semibold mb-4">Nuevo Cliente</h2>
        <form method="POST" action="{{ route('clientes.store') }}">
          @csrf

          {{-- Repite cada label/input tal como en el store() --}}
          <label class="block mb-2">
            DNI
            <input type="text" name="DNI" value="{{ old('DNI') }}"
                   class="w-full border rounded px-3 py-2" required>
          </label>

          <label class="block mb-2">
            Nombre
            <input type="text" name="NombreCliente" value="{{ old('NombreCliente') }}"
                   class="w-full border rounded px-3 py-2" required>
          </label>

          <label class="block mb-2">
            Apellido Paterno
            <input type="text" name="ApellidopCliente" value="{{ old('ApellidopCliente') }}"
                   class="w-full border rounded px-3 py-2" required>
          </label>

          <label class="block mb-2">
            Apellido Materno
            <input type="text" name="ApellidomCliente" value="{{ old('ApellidomCliente') }}"
                   class="w-full border rounded px-3 py-2" required>
          </label>

          <label class="block mb-2">
            Teléfono
            <input type="text" name="TelefonoCliente" value="{{ old('TelefonoCliente') }}"
                   class="w-full border rounded px-3 py-2" required>
          </label>

          <label class="block mb-2">
            Dirección
            <input type="text" name="UbicacionCliente" value="{{ old('UbicacionCliente') }}"
                   class="w-full border rounded px-3 py-2" required>
          </label>

          <label class="block mb-2">
            Ciudad
            <input type="text" name="CiudadCliente" value="{{ old('CiudadCliente') }}"
                   class="w-full border rounded px-3 py-2" required>
          </label>

          <label class="flex items-center mb-4">
            <input type="checkbox" name="ActivoCliente"
                   class="mr-2" {{ old('ActivoCliente') ? 'checked' : '' }}>
            Activo
          </label>

          <label class="block mb-4">
            Plan
            <select name="plan_id" required class="w-full border rounded px-3 py-2">
              <option value="">— Selecciona —</option>
              @foreach($planes as $plan)
                <option value="{{ $plan->idPlan }}"
                  {{ old('plan_id') == $plan->idPlan ? 'selected' : '' }}>
                  {{ $plan->nombrePlan }} (S/{{ $plan->precio }})
                </option>
              @endforeach
            </select>
          </label>

          <div class="flex justify-end space-x-2">
            <button type="button" @click="openModal = false"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
              Cancelar
            </button>
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
              Guardar
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>
@endsection
