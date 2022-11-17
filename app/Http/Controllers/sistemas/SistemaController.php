<?php

namespace App\Http\Controllers\sistemas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pinventario_excepciones;
use App\Models\Ppermiso;
use App\Models\Pusuariosucursal;
use App\Models\Rusuario_incidencia;

class SistemaController extends Controller
{
    public function registrarPermiso( Request $request)
    {
        $permiso = new Ppermiso();
        $permiso->idusuario = $request->usuario;
        $permiso->iddepto = $request->departamento;
        $permiso->idpuesto = $request->puesto;
        $permiso->idmodulo = $request->modulo;
        $permiso->idsubmodulo = $request->submodulo;
        $permiso->idacciones = $request->accion;
        $permiso->status = 1;
        $permiso->save();
        return response()->json($request, 200);
    }

    public function guardarExcepcion(Request $request)
    {
        if (!is_numeric($request->sucursal)) {
            $excepciones = new Pinventario_excepciones();
            $excepciones->auditor = $request->sucursal;
            $excepciones->fecha = $request->fecha;
            $excepciones->causa = strtoupper($request->causa);
            $excepciones->save();
        } else {
            $excepciones = new Pinventario_excepciones();
            $excepciones->almacen = $request->sucursal;
            $excepciones->fecha = $request->fecha;
            $excepciones->causa = strtoupper($request->causa);
            $excepciones->save();
        }
        
        /*for($j=0; $j<count($request->sucursales); $j++)
        {
            $excepciones->almacen = $request->sucursales[$j];
            $excepciones->fecha = $request->fecha;
            $excepciones->causa = $request->causa;
            $excepciones->save();
        }*/

        return response()->json(true, 200);
    }

    public function getRegistrosExcepciones($idAlmacen)
    {
        $registros = Pinventario_excepciones::where('almacen', $idAlmacen)->join('csucursal', 'inventario_excepciones.almacen', '=', 'csucursal.idprediction')->get();
        return response()->json($registros, 200);
    }

    public function saveUsuarioSucursal(Request $request)
    {
        $newUsuarioSucursal = new Pusuariosucursal();
        $newUsuarioSucursal->username = $request->username;
        $newUsuarioSucursal->idcsucursal = $request->sucursal;
        $newUsuarioSucursal->status = 1;
        $newUsuarioSucursal->save();
        return response()->json(true, 200);
    }

    public function saveUsuarioIncidencia(Request $request)
    {
        $newUsuarioIncidencia = new Rusuario_incidencia();
        $newUsuarioIncidencia->idempleado = $request->idempleado;
        $newUsuarioIncidencia->status = 1;
        switch($request->idTipoMovimiento)
        {
            case 1: //deduccion
                $checkDeduccion = Rusuario_incidencia::where('idempleado', $request->idempleado)->where('iddeduccion', $request->idincidencia)->where('status', 1)->exists();
                if($checkDeduccion == true)
                {
                    return response()->json(false, 200);
                }
                else{
                    $newUsuarioIncidencia->iddeduccion = $request->idincidencia;
                    $newUsuarioIncidencia->save();
                    return response()->json(true, 200);
                }
                
            break;
            case 2: //percepcion
                $checkPercepcion = Rusuario_incidencia::where('idempleado', $request->idempleado)->where('idpercepcion', $request->idincidencia)->where('status', 1)->exists();
                if($checkPercepcion == true)
                {
                    return response()->json(false, 200);
                }
                else{
                    $newUsuarioIncidencia->idpercepcion = $request->idincidencia;
                    $newUsuarioIncidencia->save();
                    return response()->json(true, 200);
                }
                
            break;
        }
    }

    public function deleteUsuarioSucursal($id)
    {
        $usuario = Pusuariosucursal::where('id', $id)->firstOrFail();
        $usuario->delete();
        return response()->json(true, 200);
    }

    public function updateUsuarioSucursal(Request $request)
    {
        Pusuariosucursal::where('username', $request->username)->update(['idcsucursal'=>$request->idSucursal]);
        return response()->json(true, 200);
    }
}
