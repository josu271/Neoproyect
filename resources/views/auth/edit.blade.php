<!-- resources/views/auth/clientes/edit.blade.php -->
@extends('layouts.app')

@section('title','Editar Cliente')

@section('content')
<div class="container mx-auto py-8 px-4">
  <div class="flex items-center justify-between mb-6">
    <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">← Volver</a>
    <h2 class="text-xl font-semibold">Editar Cliente</h2>
  </div>

  @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('clientes.update', $cliente->idClientes) }}" class="bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <label class="block mb-2">
      DNI
      <input type="text" name="DNI" value="{{ old('DNI', $cliente->DNI) }}" class="w-full border rounded px-3 py-2" required>
      @error('DNI')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <label class="block mb-2">
      Nombre
      <input type="text" name="NombreCliente" value="{{ old('NombreCliente', $cliente->NombreCliente) }}" class="w-full border rounded px-3 py-2" required>
      @error('NombreCliente')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <label class="block mb-2">
      Apellido Paterno
      <input type="text" name="ApellidopCliente" value="{{ old('ApellidopCliente', $cliente->ApellidopCliente) }}" class="w-full border rounded px-3 py-2" required>
      @error('ApellidopCliente')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <label class="block mb-2">
      Apellido Materno
      <input type="text" name="ApellidomCliente" value="{{ old('ApellidomCliente', $cliente->ApellidomCliente) }}" class="w-full border rounded px-3 py-2" required>
      @error('ApellidomCliente')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <label class="block mb-2">
      Teléfono
      <input type="text" name="TelefonoCliente" value="{{ old('TelefonoCliente', $cliente->TelefonoCliente) }}" class="w-full border rounded px-3 py-2" required>
      @error('TelefonoCliente')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <label class="block mb-2">
      Dirección
      <input type="text" name="UbicacionCliente" value="{{ old('UbicacionCliente', $cliente->UbicacionCliente) }}" class="w-full border rounded px-3 py-2" required>
      @error('UbicacionCliente')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <label class="block mb-2">
      Ciudad
      <input type="text" name="CiudadCliente" value="{{ old('CiudadCliente', $cliente->CiudadCliente) }}" class="w-full border rounded px-3 py-2" required>
      @error('CiudadCliente')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <label class="flex items-center mb-4">
      <input type="checkbox" name="ActivoCliente" class="mr-2" {{ old('ActivoCliente', $cliente->ActivoCliente) ? 'checked' : '' }}>
      Activo
    </label>

    <label class="block mb-4">
      Plan
      <select name="plan_id" required class="w-full border rounded px-3 py-2">
        <option value="">— Selecciona —</option>
        @foreach($planes as $plan)
          <option value="{{ $plan->idPlan }}" {{ old('plan_id', $cliente->suscripcion->idPlan) == $plan->idPlan ? 'selected' : '' }}>
            {{ $plan->nombrePlan }} (S/{{ $plan->precio }})
          </option>
        @endforeach
      </select>
      @error('plan_id')<span class="text-red-600">{{ $message }}</span>@enderror
    </label>

    <div class="flex justify-end space-x-2">
      <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
    </div>
  </form>
</div>
@endsection
