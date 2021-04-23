<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Marcacion;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MarcacionController extends Controller
{
    
    public function index(Request $request)
    {
        $marcacion = Marcacion::all();
        $matchThese = ['en1.tipoMarcacion' => 'Entrada', 'en2.tipoMarcacion' => 'Almuerzo inicio',
        'en3.tipoMarcacion' => 'Almuerzo fin', 'en4.tipoMarcacion' => 'Salida'];
        $resultado =DB::table('empleados as emp')
            ->leftJoin('marcacions as en1', 'emp.codigo', '=', 'en1.codigoEmpleado')
            ->leftJoin('marcacions as en2', 'emp.codigo', '=', 'en2.codigoEmpleado')
            ->leftJoin('marcacions as en3', 'emp.codigo', '=', 'en3.codigoEmpleado')
            ->leftJoin('marcacions as en4', 'emp.codigo', '=', 'en4.codigoEmpleado')
            ->selectRaw("concat(emp.nombre,' ',emp.apellido) as 'Empleado',
                DATE_FORMAT(en1.fechaHora,'%H:%i:%s') as 'Entrada', 
                DATE_FORMAT(en2.fechaHora,'%H:%i:%s') as 'AInicio', 
                DATE_FORMAT(en3.fechaHora,'%H:%i:%s') 'AFin',
                DATE_FORMAT(en4.fechaHora,'%H:%i:%s') 'Salida',
                TIMESTAMPDIFF(HOUR, en1.fechaHora, en4.fechaHora) -  
                TIMESTAMPDIFF(HOUR, en2.fechaHora, en3.fechaHora) as 'Cumplimiento',
                DATE_FORMAT(en4.fechaHora,'%Y-%m-%d') 'fechaHoraSalida',
                DATE_FORMAT(en1.fechaHora,'%Y-%m-%d') 'fechaHoraEntrada',
                DATE_FORMAT(en2.fechaHora,'%Y-%m-%d') 'fechaHoraAlmuerzoInicio',
                DATE_FORMAT(en3.fechaHora,'%Y-%m-%d') 'fechaHoraAlmuerzoFin' " )
            ->where($matchThese)
            ->get();
        return $resultado;
    }

    public function obtenerFechas(Request $request){
        $datosFecha = DB::table('marcacions')
            // ->orderBy('fechaHora')
            ->selectRaw('DATE(fechaHora) as fecha')
            ->groupByRaw('DATE(fechaHora)')
            ->get();

        return $datosFecha;
    }

    public function guardar(Request $request)
    {
        $fechaARevisar = date('Y-m-d', strtotime(substr($request->fechaHora,0,10)));
        $revision = DB::table('marcacions')
            ->whereRaw('codigoEmpleado = ? and tipoMarcacion = ? and DATE(fechaHora)=?',
                [$request->codigoEmpleado,$request->tipoMarcacion,$fechaARevisar])->get();

        if (count($revision)>0) {
                    return  response()->json([
                        'error' => 'Al momento ya se encuentra registrada una marcación para "'.$request->tipoMarcacion.'" en la fecha '.$fechaARevisar
                    ], 500); // Status code here
         } else {
            $marcacion = new Marcacion();
            $marcacion->codigoEmpleado = $request->codigoEmpleado;
            $marcacion->tipoMarcacion = $request->tipoMarcacion;
            $marcacion->fechaHora = $request->fechaHora;
            $marcacion->save();
         }

         
    }

    public function mostrar(Request $request)
    {
        $marcacion = Marcacion::findOrFail($request->id);
        return $marcacion;
    }

    public function actualizar(Request $request){
        $marcacion = marcacion::findOrFail($request->id);
        $marcacion->codigoEmpleado=$request->nombre;
        $marcacion->tipoMarcacion=$request->tipoMarcacion;
        $marcacion->fechaHora = $request->fechaHora;
        $marcacion->save();
        return $marcacion;   
    }

    public function destruir(Request $request){
        $marcacion=Marcacion::destroy($request->id);
        return $marcacion;   
    }
}
