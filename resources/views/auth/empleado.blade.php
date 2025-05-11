@extends('layouts.app')

@section('title', 'Empleados')

@section('content')
<div class="container mx-auto py-8" x-data="empleadoPage()">

    {{-- cabecera --}}
    <div class="flex items-center justify-between mb-6">
        <button onclick="window.location='{{ route('menu') }}'"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
            ← Volver
        </button>

        <div class="flex-1 mx-4">
            <form method="GET" class="w-full">
                <input
                  type="text"
                  name="q"
                  value="{{ $q }}"
                  placeholder="Buscar DNI o nombre..."
                  class="w-full border rounded px-3 py-2"
                />
            </form>
        </div>

        <button @click="openAdd = true"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Añadir
        </button>
    </div>

    
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">DNI</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Apellidos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Activo</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($empleados as $emp)
                <tr>
                    <td class="px-6 py-4">{{ $emp->DNI }}</td>
                    <td class="px-6 py-4">{{ $emp->NombreEmpleado }}</td>
                    <td class="px-6 py-4">{{ $emp->ApellidopEmpleado }} {{ $emp->ApellidomEmpleado }}</td>
                    <td class="px-6 py-4">{{ $emp->TelefonoEmpleado }}</td>
                    <td class="px-6 py-4">{{ $emp->RolEmpleado }}</td>
                    <td class="px-6 py-4">{{ $emp->ActivoEmpleado ? 'Sí' : 'No' }}</td>
                    <td class="px-6 py-4 text-right">
                        <button @click="edit({{ $emp->toJson() }})"
                                class="px-3 py-1 bg-yellow-400 rounded hover:bg-yellow-500">
                            Editar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $empleados->links() }}
    </div>

    
    <div x-show="openAdd" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div @click.away="openAdd = false" class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl mb-4">Nuevo Empleado</h2>
            <form method="POST" action="{{ route('empleados.store') }}">
                @csrf
                <div class="space-y-4">
                    <label class="block">
                        <span class="text-gray-700">DNI</span>
                        <input type="text" name="DNI" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Nombre</span>
                        <input type="text" name="NombreEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Apellido Paterno</span>
                        <input type="text" name="ApellidopEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Apellido Materno</span>
                        <input type="text" name="ApellidomEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Teléfono</span>
                        <input type="text" name="TelefonoEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Rol</span>
                        <input type="text" name="RolEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Activo</span>
                        <select name="ActivoEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </label>
                </div>
                <div class="mt-4 text-right">
                    <button type="button" @click="openAdd = false" class="mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    
    <div x-show="openEdit" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div @click.away="openEdit = false" class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl mb-4">Editar Empleado</h2>
            <form :action="`{{ url('empleados') }}/${selected.idEmpleado}`" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <label class="block">
                        <span class="text-gray-700">DNI</span>
                        <input type="text" name="DNI" x-bind:value="selected.DNI" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Nombre</span>
                        <input type="text" name="NombreEmpleado" x-bind:value="selected.NombreEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Apellido Paterno</span>
                        <input type="text" name="ApellidopEmpleado" x-bind:value="selected.ApellidopEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Apellido Materno</span>
                        <input type="text" name="ApellidomEmpleado" x-bind:value="selected.ApellidomEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Teléfono</span>
                        <input type="text" name="TelefonoEmpleado" x-bind:value="selected.TelefonoEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Rol</span>
                        <input type="text" name="RolEmpleado" x-bind:value="selected.RolEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Activo</span>
                        <select name="ActivoEmpleado" x-bind:value="selected.ActivoEmpleado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </label>
                </div>
                <div class="mt-4 text-right">
                    <button type="button" @click="openEdit = false" class="mr-2">Cancelar</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
function empleadoPage(){
    return {
        openAdd: false,
        openEdit: false,
        selected: {},
        edit(emp){
            this.selected = emp;
            this.openEdit = true;
        }
    }
}
</script>
@endpush
@endsection
