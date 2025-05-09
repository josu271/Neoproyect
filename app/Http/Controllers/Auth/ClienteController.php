<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Plan;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // listado de clientes (índice)
    public function index(Request $request)
    {
        $q = $request->input('q');
        $query = Cliente::with('suscripcion.plan');
        if ($q) {
            $query->where(fn($w) =>
                $w->where('NombreCliente','like',"%{$q}%")
                  ->orWhere('ApellidopCliente','like',"%{$q}%")
                  ->orWhere('DNI','like',"%{$q}%")
            );
        }

        $clientes = $query->paginate(10)->withQueryString();
        $planes    = Plan::all();
        return view('auth.cliente', compact('clientes','planes','q'));
    }

    // almacena nuevo cliente + suscripción
    public function store(Request $request)
    {
        $data = $request->validate([
            'DNI'               => 'required|string|max:45',
            'NombreCliente'     => 'required|string|max:45',
            'ApellidopCliente'  => 'required|string|max:45',
            'ApellidomCliente'  => 'required|string|max:45',
            'TelefonoCliente'   => 'required|string|max:45',
            'UbicacionCliente'  => 'required|string|max:45',
            'CiudadCliente'     => 'required|string|max:45',
            'ActivoCliente'     => 'sometimes|boolean',
            'plan_id'           => 'required|exists:planes,idPlan',
        ]);

        $data['ActivoCliente'] = $request->has('ActivoCliente') ? 1 : 0;
        $cliente = Cliente::create($data);
        $cliente->suscripcion()->create([
            'idPlan'     => $data['plan_id'],
            'FechaInicio'=> now(),
            'Estado'     => 'activa',
        ]);

        return redirect()->route('clientes.index')
                         ->with('success','Cliente creado correctamente.');
    }

    // muestra formulario para editar
    public function edit(Cliente $cliente)
    {
        $planes = Plan::all();
        return view('auth.edit', compact('cliente','planes'));
    }

    // guarda edición
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'DNI'               => 'required|string|max:45',
            'NombreCliente'     => 'required|string|max:45',
            'ApellidopCliente'  => 'required|string|max:45',
            'ApellidomCliente'  => 'required|string|max:45',
            'TelefonoCliente'   => 'required|string|max:45',
            'UbicacionCliente'  => 'required|string|max:45',
            'CiudadCliente'     => 'required|string|max:45',
            'ActivoCliente'     => 'sometimes|boolean',
            'plan_id'           => 'required|exists:planes,idPlan',
        ]);

        $data['ActivoCliente'] = $request->has('ActivoCliente') ? 1 : 0;
        $cliente->update($data);
        $cliente->suscripcion->update(['idPlan'=>$data['plan_id']]);

        return redirect()->route('clientes.index')
                         ->with('success','Cliente actualizado.');
    }

    // elimina cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
                         ->with('success','Cliente eliminado.');
    }
}