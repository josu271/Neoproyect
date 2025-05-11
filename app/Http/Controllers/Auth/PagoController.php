<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\TipoComprobante;
use App\Models\MetodoPago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Mostrar listado de pagos con buscador y paginación.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pagos = Pago::with(['cliente', 'empleado', 'tipoComprobante', 'metodoPago'])
            ->when($search, function($q) use ($search) {
                $q->whereHas('cliente', fn($q2) =>
                    $q2->where('NombreCliente','like', "%{$search}%")
                        ->orWhere('ApellidopCliente','like', "%{$search}%")
                        ->orWhere('ApellidomCliente','like', "%{$search}%")
                );
            })
            ->orderBy('FechaPago','desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('auth.pago', compact('pagos','search'));
    }

    /**
     * Mostrar formulario de creación de pago.
     */
    public function create()
    {
        $clientes           = Cliente::all();
        $empleados          = Empleado::all();
        $tiposComprobante   = TipoComprobante::all();
        $metodosPago        = MetodoPago::all();

        return view('auth.pago', compact(
            'clientes','empleados','tiposComprobante','metodosPago'
        ));
    }

    /**
     * Almacenar un nuevo pago en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idClientes'        => 'required|exists:clientes,idClientes',
            'idEmpleado'        => 'required|exists:empleado,idEmpleado',
            'idTipoComprobante' => 'required|exists:tipo_comprobante,idTipoComprobante',
            'idMetodoPago'      => 'required|exists:metodo_pago,idMetodoPago',
            'ActivoPago'        => 'required|string|max:45',
            'PeriodoMes'        => 'required|date_format:Y-m',
            'FechaPago'         => 'nullable|date',
        ]);

        Pago::create($data);

        return redirect()->route('pago.index')
                         ->with('success','Pago registrado correctamente.');
    }

    /**
     * Mostrar detalle de un pago.
     */
    public function show(Pago $pago)
    {
        $pago->load(['cliente','empleado','tipoComprobante','metodoPago']);
        return view('auth.pago', compact('pago'));
    }

    /**
     * Mostrar formulario de edición de un pago existente.
     */
    public function edit(Pago $pago)
    {
        $clientes           = Cliente::all();
        $empleados          = Empleado::all();
        $tiposComprobante   = TipoComprobante::all();
        $metodosPago        = MetodoPago::all();

        return view('auth.pago.edit', compact(
            'pago','clientes','empleados','tiposComprobante','metodosPago'
        ));
    }

    /**
     * Actualizar los datos de un pago.
     */
    public function update(Request $request, Pago $pago)
    {
        $data = $request->validate([
            'idClientes'        => 'required|exists:clientes,idClientes',
            'idEmpleado'        => 'required|exists:empleado,idEmpleado',
            'idTipoComprobante' => 'required|exists:tipo_comprobante,idTipoComprobante',
            'idMetodoPago'      => 'required|exists:metodo_pago,idMetodoPago',
            'ActivoPago'        => 'required|string|max:45',
            'PeriodoMes'        => 'required|date_format:Y-m',
            'FechaPago'         => 'nullable|date',
        ]);

        $pago->update($data);

        return redirect()->route('pago.index')
                         ->with('success','Pago actualizado correctamente.');
    }

    /**
     * Eliminar un pago.
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();

        return redirect()->route('pago.index')
                         ->with('success','Pago eliminado correctamente.');
    }
}
