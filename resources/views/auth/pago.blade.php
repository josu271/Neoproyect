@extends('layouts.app')

@section('content')
<div x-data="pagoApp()" class="container mx-auto p-4">
  <div class="flex justify-between items-center mb-4">
    <!-- Botón “Retroceder” -->
    <a href="{{ route('menu') }}"
   class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
  ← Volver al menú
</a>

    <!-- Barra de búsqueda -->
    <form action="{{ route('pago.index') }}" method="get" class="flex">
      <input
        type="text"
        name="search"
        value="{{ old('search', $search ?? '') }}"
        placeholder="Buscar por nombre o apellido"
        class="border rounded-l p-2 w-64"
      >
      <button type="submit" class="bg-blue-500 text-white px-4 rounded-r hover:bg-blue-600">
        Buscar
      </button>
    </form>

    <!-- Botón “Añadir” -->
    <button
      @click="openAddModal()"
      class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
      + Añadir Pago
    </button>
  </div>

  <!-- Tabla de resultados -->
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border">
      <thead>
        <tr>
          <th class="px-4 py-2 border">#</th>
          <th class="px-4 py-2 border">Cliente</th>
          <th class="px-4 py-2 border">Fecha</th>
          <th class="px-4 py-2 border">Periodo</th>
          <th class="px-4 py-2 border">Estado</th>
          <th class="px-4 py-2 border">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pagos as $pago)
          <tr>
            <td class="px-4 py-2 border">{{ $pago->idPagos }}</td>
            <td class="px-4 py-2 border">
              {{ $pago->cliente->NombreCliente }} {{ $pago->cliente->ApellidopCliente }} {{ $pago->cliente->ApellidomCliente }}
            </td>
            <td class="px-4 py-2 border">{{ $pago->FechaPago }}</td>
            <td class="px-4 py-2 border">{{ $pago->PeriodoMes }}</td>
            <td class="px-4 py-2 border">{{ $pago->ActivoPago }}</td>
            <td class="px-4 py-2 border space-x-2">
              <!-- Editar -->
              <button
                @click="openEditModal({
                  id: {{ $pago->idPagos }},
                  cliente: '{{ $pago->cliente->NombreCliente }} {{ $pago->cliente->ApellidopCliente }}',
                  fecha: '{{ $pago->FechaPago }}',
                  periodo: '{{ $pago->PeriodoMes }}',
                  estado: '{{ $pago->ActivoPago }}'
                })"
                class="text-blue-600 hover:underline">
                Editar
              </button>

              <!-- Eliminar -->
              <form action="{{ route('pago.destroy', $pago->idPagos) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar pago #{{ $pago->idPagos }}?')" class="text-red-600 hover:underline">
                  Eliminar
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Paginación -->
  <div class="mt-4">{{ $pagos->links() }}</div>

  <!-- Modal: Añadir Pago -->
  <div
    x-show="showAdd"
    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center"
  >
    <div class="bg-white rounded-lg p-6 w-1/2">
      <h2 class="text-xl mb-4">Nuevo Pago</h2>
      <form action="{{ route('pago.store') }}" method="POST">
        @csrf
        <!-- Aquí tus campos: cliente, tipo comprobante, etc. -->
        <div class="mb-4">
          <label>Cliente</label>
          <select name="idClientes" class="w-full border rounded p-2">
            @foreach(\App\Models\Cliente::all() as $cliente)
              <option value="{{ $cliente->idClientes }}">{{ $cliente->NombreCliente }} {{ $cliente->ApellidopCliente }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label>Periodo</label>
          <input type="month" name="PeriodoMes" class="w-full border rounded p-2">
        </div>
        <div class="mb-4">
          <label>Estado</label>
          <input type="text" name="ActivoPago" class="w-full border rounded p-2">
        </div>
        <div class="flex justify-end space-x-2">
          <button type="button" @click="closeAddModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
          <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Editar Pago -->
  <div
    x-show="showEdit"
    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center"
  >
    <div class="bg-white rounded-lg p-6 w-1/2">
      <h2 class="text-xl mb-4">Editar Pago #<span x-text="editData.id"></span></h2>
      <form :action="`/pago/${editData.id}`" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label>Cliente</label>
          <input type="text" x-model="editData.cliente" disabled class="w-full border rounded p-2 bg-gray-100">
        </div>
        <div class="mb-4">
          <label>Periodo</label>
          <input type="month" name="PeriodoMes" x-model="editData.periodo" class="w-full border rounded p-2">
        </div>
        <div class="mb-4">
          <label>Estado</label>
          <input type="text" name="ActivoPago" x-model="editData.estado" class="w-full border rounded p-2">
        </div>
        <div class="flex justify-end space-x-2">
          <button type="button" @click="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function pagoApp() {
  return {
    showAdd: false,
    showEdit: false,
    editData: { id: null, cliente: '', fecha: '', periodo: '', estado: '' },
    openAddModal() {
      this.showAdd = true;
    },
    closeAddModal() {
      this.showAdd = false;
    },
    openEditModal(data) {
      this.editData = data;
      this.showEdit = true;
    },
    closeEditModal() {
      this.showEdit = false;
    }
  }
}
</script>
@endsection
