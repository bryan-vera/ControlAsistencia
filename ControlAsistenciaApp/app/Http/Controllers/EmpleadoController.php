<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function marcaciones()
    {
        return $this->hasMany(Marcacion::class,'codigoEmpleado','codigo');
    }

    public function obtenerDropdown()
    {
        $coleccion = Empleado::get(['codigo','nombre','apellido']);
        foreach ($coleccion as $item) {
            $arrayEmpleados[$item->codigo]  = $item->nombre.' '.$item->apellido;
        }
        return response()->json($arrayEmpleados,200);
    }

    public function index(Request $request)
    {
        $empleado = Empleado::all();
        return $empleado;
        //
    }

    public function guardar(Request $request)
    {
        $empleado = new Empleado();
        $empleado->codigo = $request->codigo;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->save();
    }

    public function mostrar(Request $request)
    {
        $empleado = Empleado::findOrFail($request->codigo);
        return $empleado;
    }

    public function actualizar(Request $request){
        $empleado = Empleado::findOrFail($request->codigo);
        $empleado->nombre=$request->nombre;
        $empleado->apellido=$request->apellido;
        $empleado->save();
        return $empleado;   
    }

    public function destruir(Request $request){
        $empleado=Empleado::destroy($request->codigo);
        return $empleado;   
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
