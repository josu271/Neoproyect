<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $empleados = Empleado::when($q, fn($query) =>
             $query->where('DNI', 'like', "%{$q}%")
                   ->orWhere('NombreEmpleado', 'like', "%{$q}%")
        )->orderBy('idEmpleado', 'desc')
         ->paginate(10)
         ->withQueryString();

    return view('auth.empleado', compact('empleados', 'q'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'DNI'              => 'required|numeric|unique:empleado,DNI',
            'NombreEmpleado'   => 'required|string',
            'ApellidopEmpleado'=> 'required|string',
            'ApellidomEmpleado'=> 'required|string',
            'TelefonoEmpleado' => 'required|string',
            'RolEmpleado'      => 'required|string',
            'ActivoEmpleado'   => 'required|in:0,1',
        ]);
        Empleado::create($data);
        return back()->with('success', 'Empleado creado.');
    }

    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->validate([
            'DNI'              => "required|numeric|unique:empleado,DNI,{$empleado->idEmpleado},idEmpleado",
            'NombreEmpleado'   => 'required|string',
            'ApellidopEmpleado'=> 'required|string',
            'ApellidomEmpleado'=> 'required|string',
            'TelefonoEmpleado' => 'required|string',
            'RolEmpleado'      => 'required|string',
            'ActivoEmpleado'   => 'required|in:0,1',
        ]);
        $empleado->update($data);
        return back()->with('success', 'Empleado actualizado.');
    }
}
