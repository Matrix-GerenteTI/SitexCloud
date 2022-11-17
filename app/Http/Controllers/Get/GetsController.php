<?php

namespace App\Http\Controllers\Get;

use DateTime;
use App\Models\Csexo;
use App\Models\Cbanco;
use App\Models\Cestado;
use App\Models\Cpuesto;
use App\Models\Csucursal;
use App\Models\Pempleado;
use App\Models\Ctiposangre;
use App\Models\Cestadocivil;
use App\Models\Ctipojornada;
use App\Models\Ctiporegimen;
use App\Models\Ctipousuario;
use App\Models\Cdepartamento;
use App\Models\Cnivelestudio;
use App\Models\Criesgopuesto;
use App\Models\Ctipocontrato;
use App\Models\Ctiempocontrato;
use App\Models\Cperiodicidadpago;
use App\Http\Controllers\Controller;
use App\Models\Cacciones;
use App\Models\Cautos_marca;
use App\Models\Cautos_modelo;
use App\Models\Ccategoria;
use App\Models\Cmodulo;
use App\Models\Csubcategoria;
use App\Models\Csubmodulo;
use App\Models\Ctipodoc;
use App\Models\Ctipoticket;
use App\Models\Ctipoventa;
use App\Models\Pcavim;
use App\Models\Ptickets;
use App\Models\Pusuarios;
use App\Models\Pusuariosucursal;
use Illuminate\Support\Facades\Http;

class GetsController extends Controller
{
    public function getSucursal()
    {
        $sucursales = Csucursal::orderby('descripcion')->where('status', 1)->get();
        $arreglo = [];
        array_push($arreglo,$sucursales);
        //dd($sucursales);
        $auditores = array(
            "correo" => "",
            "descripcion"=>"C.P. Felipe Rosales Rosales",
            "filiacion"=>"",
            "id"=>"",
            "idherramienta"=>"",
            "idprediction"=>"C.P. Felipe Rosales Rosales",
            "idreloj"=>"",
            "menuapp"=>"",
            "preporte"=>"",
            "prorrateo"=>"",
            "status"=>"",
            "zona"=>"",
        );
        $sucursales->prepend($auditores);
        $auditores = array(
            "correo"=> "",
            "descripcion"=>"C.P. Feliciano Coutino de la Torre",
            "filiacion"=>"",
            "id"=>"",
            "idherramienta"=>"",
            "idprediction"=>"C.P. Feliciano Coutino de la Torre",
            "idreloj"=>"",
            "menuapp"=>"",
            "preporte"=>"",
            "prorrateo"=>"",
            "status"=>"",
            "zona"=>"",
        );
        $sucursales->prepend($auditores);
        $auditores = array(
            "correo"=> "",
            "descripcion"=>"Lic. Guadalupe de Jesus Ralda Bautista",
            "filiacion"=>"",
            "id"=>"",
            "idherramienta"=>"",
            "idprediction"=>"Lic. Guadalupe de Jesus Ralda Bautista",
            "idreloj"=>"",
            "menuapp"=>"",
            "preporte"=>"",
            "prorrateo"=>"",
            "status"=>"",
            "zona"=>"",
        );
        $sucursales->prepend($auditores);
        //dd($arreglo);
        return response()->json($sucursales, 200);
    }
    public function getDepartamento()
    {
        $departamento = Cdepartamento::select('id', 'descripcion')->where('status', 1)->orderby('descripcion')->get();
        return response()->json($departamento, 200);
    }
    public function getPuesto($idDepartamento)
    {
        $puesto = Cpuesto::select('id', 'descripcion')->where('status', 1)->where('iddepartamento', $idDepartamento)->orderby('descripcion')->get();
        return response()->json($puesto, 200);
    }
    public function getEmpleado($idPuesto)
    {
        $empleado = Pempleado::select('pempleado.nip', 'pempleado.nombre')
        ->join('pcontrato', 'pempleado.nip', '=', 'pcontrato.nip')
        ->where('pempleado.status', 1)
        ->where('pcontrato.idpuesto', $idPuesto)
        ->orderby('pempleado.nombre')->get();
        return response()->json($empleado, 200);
    }
    public function getEstadosRepublica()
    {
        $estados = Cestado::where('cve_pais', 'MEX')->get();
        return response()->json($estados, 200);
    }
    public function getEstadoCivil()
    {
        $estadoCivil = Cestadocivil::select('descripcionEstadoCivil')->get();
        return response()->json($estadoCivil, 200);
    }
    public function getSexo()
    {
        $sexo = Csexo::select('descripcionSexo')->get();
        return response()->json($sexo, 200);
    }
    public function getNivelEstudio()
    {
        $nivel = Cnivelestudio::select('descripcionEscolaridad')->get();
        return response()->json($nivel, 200);
    }
    public function getTipoSangre()
    {
        $sangre = Ctiposangre::select('descripcionSangre')->get();
        return response()->json($sangre, 200);
    }  
    public function getTipoUsuario()
    {
        $usuarios = Ctipousuario::all();
        return response()->json($usuarios, 200);
    }  
    public function getTipoContrato()
    {
        $tipoContrato = Ctipocontrato::orderby('descripcion')->get();
        return response()->json($tipoContrato, 200);
    }  
    public function getTiempoContrato()
    {
        $tiempo = Ctiempocontrato::all();
        return response()->json($tiempo, 200);
    }  
    public function getTipoJornada()
    {
        $jornada = Ctipojornada::orderby('descripcion')->get();
        return response()->json($jornada, 200);
    }  
    public function getAntiguedad($date)
    {
        $fecha1 = new DateTime($date);
        $fecha2 = new DateTime(date('Y-m-d'));
        $fecha = $fecha1->diff($fecha2);
        return "P".$fecha->y."Y".$fecha->m."M".$fecha->d."D";
    }
    public function getTipoRegimen()
    {
        $regimen = Ctiporegimen::orderby('descripcion')->get();
        return response()->json($regimen, 200);
    } 
    public function getRiesgoPuesto()
    {
        $riesgo = Criesgopuesto::all();
        return response()->json($riesgo, 200);
    }
    public function getPeriodicidadPago()
    {
        $periodicidad = Cperiodicidadpago::orderby('descripcion')->get();
        return response()->json($periodicidad, 200);
    }
    public function getBancos()
    {
        $bancos = Cbanco::orderby('descripcion')->get();
        return response()->json($bancos, 200);
    }
    public function getEmpleadosAll()
    {
        $empleadosAll = Pempleado::select('pempleado.nip', 'pempleado.nombre', 'cdepartamento.id', 'cdepartamento.descripcion')
        ->join('pcontrato', 'pempleado.nip', '=', 'pcontrato.nip')
        ->join('cdepartamento', 'pcontrato.iddepartamento', '=', 'cdepartamento.id')
        ->where('pempleado.status', 1)
        ->orderby('pempleado.nombre')->get();
        return response()->json($empleadosAll, 200);
    }
    public function getTipoDocumentos()
    {
        $tipoDoc = Ctipodoc::orderby('descripcion')->get();
        return response()->json($tipoDoc, 200);
    }

    public function getMarca()
    {
        $marca = Cautos_marca::select('id', 'marca')->orderby('marca')->get();
        return response()->json($marca, 200);
    }

    public function getLinea($idMarca)
    {
        $linea = Cautos_modelo::where('idmarca', $idMarca)->groupby('modelo')->orderby('modelo')->get(['id', 'modelo']);
        return response()->json($linea, 200);
    }

    public function getRegistrosCavim($fecha)
    {
        $registro = Pcavim::select('pcavim.id', 'pcavim.idsucursal', 'idautos_modelo', 'color', 'telefono', 'fecha', 'hora', 'fechai', 'horai', 
        'fechaf', 'horaf', 'prediction_id', 'prediction_folio', 'prediction_idvendedor', 'prediction_vendedor', 'prediction_total', 
        'prediction_fecha', 'prediction_hora', 'csucursal.descripcion', 'cautos_modelo.modelo', 'cautos_marca.marca')
        ->join('csucursal', 'pcavim.idsucursal', '=', 'csucursal.idprediction')
        ->join('cautos_modelo', 'pcavim.idautos_modelo', '=', 'cautos_modelo.id')
        ->join('cautos_marca', 'cautos_modelo.idmarca' , '=', 'cautos_marca.id')
        ->where('prediction_fecha', $fecha)->get();
        //$registro = Pcavim::where('prediction_fecha', $fecha)->get();
        return response()->json($registro, 200);
    }

    public function getTicketsPrediction($fecha)
    {
        $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/cavim/getTickets/'.$fecha);
        $res = $respuesta->json();
        return response()->json($res, 200);
    }

    public function existsTicketRegister($id)
    {
        $idTicket = Pcavim::where('prediction_id', $id)->exists();
        return response()->json($idTicket, 200);
    }

    public function getUsuarioPermiso($puesto)
    {
        $usuario = Pempleado::select('pempleado.nip', 'nombre')->join('pcontrato', 'pempleado.nip', '=', 'pcontrato.nip')->where('pcontrato.idpuesto', $puesto)->where('pempleado.status', 1)->get();
        return response()->json($usuario, 200);
    }

    public function getModulo()
    {
        $modulo = Cmodulo::select('id', 'descripcion')->orderby('descripcion')->where('status', 1)->get();
        return response()->json($modulo, 200);
    }

    public function getSubmodulo($id)
    {
        $submodulo = Csubmodulo::select('id', 'descripcion')->orderby('descripcion')->where('status', 1)->where('idmodulo', $id)->get();
        return response()->json($submodulo, 200);
    }

    public function getAccion($id)
    {
        $accion = Cacciones::select('id', 'descripcion')->orderby('descripcion')->where('status', 1)->where('idsubmodulo', $id)->get();
        return response()->json($accion, 200);
    }

    public function getCategoria()
    {
        $categoria = Ccategoria::select('id', 'nombreCategoria')->where('status', 1)->get();
        return response()->json($categoria, 200);
    }

    public function getSubcategoria($id)
    {
        $subcategoria = Csubcategoria::select('id', 'nombreSubcategoria')->where('ccategoria_id', $id)->where('status', 1)->orderby('nombreSubcategoria')->get();
        return response()->json($subcategoria, 200);
    }

    public function getUsuarios()
    {
        $users = Pusuarios::select('username', 'pusuarios.nombre')
        ->join('pempleado', 'pusuarios.idempleado', '=', 'pempleado.nip')
        ->where('pempleado.status', 1)->orderby('pusuarios.nombre')->get();
        return response()->json($users, 200);
    }

    public function getNameCliente($name)
    {
        $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/sitexcloud/getClientesActivos/'.$name);
        $res = $respuesta->json();
        return response()->json($res, 200);
    }
    
    public function getFormaPago()
    {
        $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/sitexcloud/facturacion/getFormasPagos');
        $res = $respuesta->json();
        return response()->json($res, 200);
    } 

    public function getUsoCfdi()
    {
        $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/sitexcloud/facturacion/getUsoCFDI');
        $res = $respuesta->json();
        return response()->json($res, 200);
    } 

    public function getRegistrosUsuarioSucursal($usuario)
    {
        if($usuario == 'TODOS')
        $respuesta = Pusuariosucursal::select('pusuariosucursal.id', 'pusuariosucursal.username', 'csucursal.descripcion')
            ->where('pusuariosucursal.status', 1)->join('csucursal', 'pusuariosucursal.idcsucursal', '=', 'csucursal.id')->get();
        else
            $respuesta = Pusuariosucursal::select('pusuariosucursal.id', 'pusuariosucursal.username', 'csucursal.descripcion')
            ->where('username', $usuario)->where('pusuariosucursal.status', 1)
            ->join('csucursal', 'pusuariosucursal.idcsucursal', '=', 'csucursal.id')->get();
        return response()->json($respuesta, 200);
    }

    public function getTipoVenta()
    {
        $tipo = Ctipoventa::where('status', 1)->get();
        return response()->json($tipo, 200);
    }

    public function getTipoTicket()
    {
        $tipo = Ctipoticket::where('status', 1)->get();
        return response()->json($tipo, 200);
    }

    public function searchEmpleado($data)
    {
        $empleado = Pempleado::select('pempleado.nip', 'pempleado.nombre', 'csucursal.id AS idSucursal', 'csucursal.descripcion', 
        'pempleado.celular', 'cdepartamento.id AS iddepartamento', 'cdepartamento.descripcion AS departamento', 'cpuesto.id AS idpuesto', 
        'cpuesto.descripcion AS puesto', 'pdireccion.calle', 'pdireccion.numext', 'pdireccion.colonia', 'csucursal.descripcion AS nameSucursal')
        ->join('csucursal', 'pempleado.idsucursal', '=', 'csucursal.id')
        ->join('pdireccion', 'pempleado.nip', '=', 'pdireccion.nip')
        ->join('pcontrato', 'pempleado.nip', '=', 'pcontrato.nip')
        ->join('cdepartamento', 'pcontrato.iddepartamento', '=', 'cdepartamento.id')
        ->join('cpuesto', 'pcontrato.idpuesto', '=', 'cpuesto.id')
        ->where('nombre', 'like', '%'.$data.'%')->where('pempleado.status', 1)->get();
        return response()->json($empleado, 200);
    }

    public function getAllSubcategorias()
    {
        $allSubcategorias = Csubcategoria::select('id', 'nombreSubcategoria')->where('status', 1)->orderby('nombreSubcategoria')->get();
        return response()->json($allSubcategorias, 200);
    }
}
