<?php

namespace App\Http\Controllers\Nomina;

use DateTime;
use App\Models\Cestado;
use App\Models\Cpuesto;
use App\Models\Pcontrato;
use App\Models\Pempleado;
use App\Models\Pusuarios;
use App\Models\Pdireccion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Cambios_adscripcion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Cparametrosasistencia;
use Intervention\Image\Facades\Image;

class NominaController extends Controller
{
    public function registerParametros(Request $request)
    {
        $parametro = Cparametrosasistencia::where('idpuesto', $request->puesto)->where('idempleado', $request->empleado)->exists();
        if($parametro == false)
        {
            $registro = new Cparametrosasistencia();
            $registro->iddepartamento = $request->input('departamento');
            $registro->idpuesto = $request->input('puesto');
            $registro->idsucursal = $request->input('sucursal');
            $registro->idempleado = $request->input('empleado');
            $registro->entrada = $request->input('horaEntrada');
            $registro->salida = $request->input('horaSalida');
            $registro->entradai = $request->input('entradaIntermedia');
            $registro->salidai = $request->input('salidaIntermedia');
            $registro->tolerancia = $request->input('tolerancia');
            $registro->toleranciafalta = $request->input('toleranciaFalta');
            $registro->retardospfalta = $request->input('retardos');
            $registro->faltaspdescuento = $request->input('descuento');
            $registro->corrido = $request->input('corrido');
            $registro->status = $request->input('status');
            $registro->save();
            return response()->json(true, 200);
        }
        else{
            return response()->json(false, 200);
        }   
    }
    public function agregarEmpleado(Request $request)
    {
        $empleado = new Pempleado();
        //Se obtiene la CURP para saber si ya existe
        $getCURP = Pempleado::where('curp', $request->curp)->where('status', 1)->exists();
        if($getCURP == true){
            return response()->json('La CURP ingresada ya se encuentra registrada', 200);
        }
        else{
            $getRFC = Pempleado::where('rfc', $request->rfc)->where('status', 1)->exists();
            if($getRFC == true){
                return response()->json('El RFC ingresado ya se encuentra registrado', 200);
            }
            else{
                $getUsername = Pusuarios::where('username', $request->username)->where('status', 1)->exists();
                if($getUsername == true){
                    return response()->json('El usuario ingresado ya existe', 200);
                }
                else{
                    $empleado->asistencia = NULL;
                    $empleado->rfc = $request->input('rfc');
                    $empleado->nombre = $request->input('nombre');
                    $empleado->curp = strtoupper($request->input('curp'));
                    $empleado->nss = $request->input('nss');
                    $empleado->fechanac = $request->input('fechaNacimiento');
                    $empleado->edocivil = $request->input('estadoCivil');
                    $empleado->sexo = $request->input('sexo');
                    $empleado->email = $request->input('email');
                    $empleado->telefono = $request->input('telefonoFijo');
                    $empleado->celular = $request->input('telefonoCelular');
                    $empleado->extension = NULL;
                    $empleado->idpatron = 1;
                    $empleado->status = 1;
                    $empleado->idsucursal = $request->input('sucursal');
                    $empleado->foto = NULL;
                    $empleado->fecha_baja = NULL;
                    $empleado->tiposangre = $request->input('tipoSangre');
                    $empleado->nivelestudios = $request->input('escolaridad');
                    $empleado->numhijos = $request->input('hijos');
                    $empleado->religion = $request->input('religion');
                    $empleado->alergias = $request->input('alergias');
                    $empleado->asegurado = $request->input('asegurado');
                    $empleado->save();

                    $usuario = new Pusuarios();
                    $getNIP = Pempleado::select('nip')->where('curp', $request->curp)->where('status', 1)->get();
                    $usuario->username = $request->input('username');
                    $usuario->password = $request->input('password');
                    $usuario->nombre = $request->input('nombre');
                    $usuario->email = $request->input('email');
                    $usuario->tipo = $request->input('tipoUsuario');
                    $usuario->idempleado = $getNIP[0]->nip;
                    $usuario->status = 1;
                    $usuario->save();

                    $direccion = new Pdireccion();
                    $direccion->nip = $getNIP[0]->nip;
                    $direccion->calle = $request->input('calle');
                    $direccion->numext = $request->input('numExt');
                    $direccion->numint = $request->input('numInt');
                    $direccion->colonia = $request->input('colonia');
                    $direccion->municipio = $request->input('municipio');
                    $direccion->cp = $request->input('cp');
                    $direccion->idestado = $request->input('estado');
                    $direccion->status = 1;
                    $direccion->save();

                    $contrato = new Pcontrato();
                    $getIdDireccion = Pdireccion::select('id')->where('nip', $getNIP[0]->nip)->where('status', 1)->get();
                    $contrato->nip = $getNIP[0]->nip;
                    $contrato->iddireccion = $getIdDireccion[0]->id;
                    $contrato->iddepartamento = $request->input('departamento');
                    $contrato->idpuesto = $request->input('puesto');
                    $contrato->idtipocontrato = $request->input('tipoContrato');
                    $contrato->idtipojornada = $request->input('tipoJornada');
                    $contrato->fechainiciolab = $request->input('fechaInicioLaboral');
                    $contrato->sindicalizado = $request->input('sindicalizado');
                    $contrato->idtiporegimen = $request->input('tipoRegimen');
                    $contrato->idriesgopuesto = $request->input('riesgoPuesto');
                    $contrato->idperiodicidadpago = $request->input('periodicidadPago');
                    $contrato->salariobase = $request->input('salarioBase');
                    $contrato->salariodiario = $request->input('salarioDiario');
                    $contrato->idbanco = $request->input('bancos');
                    $contrato->cuentabancaria = $request->input('cuentaBancaria');
                    $contrato->subrfc = $request->input('subRfc');
                    $contrato->subporcentaje = $request->input('subPorcentaje');
                    $fechatimestamp = new DateTime();
                    $contrato->timestamp = $fechatimestamp->format('Y-m-d H:i:s');
                    $contrato->status = 1;
                    $contrato->fecha_ingreso = $request->input('fechaInicioLaboral');
                    $contrato->idtiempocontrato = $request->input('tiempoContrato');
                    $contrato->fechaBaja = NULL;
                    $contrato->save();

                    $adscripcion = new Cambios_adscripcion();
                    $adscripcion->sucursal_salida_id = $request->input('sucursal');
                    $adscripcion->sucursal_llegada_id = -1;
                    $adscripcion->puesto_id = $request->input('puesto');
                    $adscripcion->fecha = $request->input('fechaInicioLaboral');
                    $adscripcion->trabajador_id = $getNIP[0]->nip;
                    $adscripcion->tipo_movto = 'ingreso';
                    $adscripcion->sueldo = $request->input('salarioBase');
                    $adscripcion->save();

                    return response()->json(true, 200);
                }
            }
        }
    }
    public function editEmpleado($nip)
    {
        $empleado = Pempleado::where('nip', $nip)->where('status', 1)->firstOrFail();
        return response()->json($empleado, 200);
        //$empleado = Pempleado::where('nip', 1)->get();
    }

    public function editDireccion($nip)
    {
        $direccion = Pdireccion::where('nip', $nip)->where('status', 1)->firstOrFail();
        return response()->json($direccion, 200);
        //$direccion = Pdireccion::where('nip', 1)->firstOrFail();
    }
    public function editUsuario($nip)
    {
        $usuario = Pusuarios::where('idempleado', $nip)->where('status', 1)->firstOrFail();
        return response()->json($usuario, 200);
    }
    public function editFotoEmpleado($nip)
    {
        $formatos = ['jpg','jpeg'];
            foreach ($formatos as $formato) 
            {
                $path = public_path("../../intranet/Empresa/foto_empleado/".$nip.".".$formato);
                if(File::exists($path) == true)
                {
                    return response()->json($formato, 200);
                    break;
                }else{
                    
                }
            }
            return response()->json(false, 200);
    }
    public function editContrato($nip)
    {
        $contrato = Pcontrato::where('nip', $nip)->where('status', 1)->firstOrFail();
        return response()->json($contrato, 200);
    }

    public function updateEmpleado($nip, Request $request)
    {
        $empleado = Pempleado::where('nip', $nip)->where('status', 1)->firstOrFail();
        //Si la CURP que se ingresa ya existe en algun otro empleado que sea diferente a este
        $getCURP = Pempleado::where('curp', $request->curp)->where('nip', '!=', $nip->where('status', 1))->exists();
        if($getCURP == true){
            return response()->json('La CURP ingresada ya se encuentra registrada en otro empleado', 200);
        }
        else{
            $getRFC = Pempleado::where('rfc', $request->rfc)->where('nip', '!=', $nip)->where('status', 1)->exists();
            if($getRFC == true){
                return response()->json('El RFC ingresado ya se encuentra registrado en otro empleado', 200);
            }
            else{
                $getUsername = Pusuarios::where('username', $request->username)->where('idempleado', '!=', $nip)->where('status', 1)->exists();
                if($getUsername == true){
                    return response()->json('El usuario ingresado ya existe en otro empleado', 200);
                }
                else{
                    $empleado->curp = $request->input('curp');
                    $empleado->email = strtoupper($request->input('email'));
                    $empleado->save();
                    return response()->json(true, 200);
                }
            }
        }
    }
    public function bajaEmpleado($nip)
    {
        return response()->json(true, 200);
    }
    public function changeAdscripcion(Request $request)
    {
        $cambioAdscripcion = new Cambios_adscripcion();
        $cambioAdscripcion->sucursal_salida_id = $request->input('sucursalSalida');
        $cambioAdscripcion->sucursal_llegada_id = $request->input('sucursalLlegada');
        $cambioAdscripcion->puesto_id = $request->input('idPuesto');
        $cambioAdscripcion->fecha = $request->input('fechaCambio');
        $cambioAdscripcion->trabajador_id = $request->input('idEmpleado');
        $cambioAdscripcion->tipo_movto = $request->input('tipoMovimiento');
        $cambioAdscripcion->sueldo = $request->input('sueldo');
        $cambioAdscripcion->save();
        return response()->json(true, 200);
    }
    public function renovarContrato(Request $request)
    {
        $empleado = Pempleado::where('nip', $request->nip)->where('status', 1)->firstOrFail();
        return response()->json($request->nip, 200);
    }

    public function generatePDFcontrato(Request $request)
    {
        setlocale(LC_TIME, "spanish");
        $fecha = strftime("%d de %B de %Y", strtotime($request->fecha));
        $request->merge(['fecha' => $fecha]);

        $puesto = Cpuesto::select('descripcion')->where('id', $request->puesto)->firstOrFail();
        $request->merge(['puesto' => $puesto->descripcion]);

        if($request->sexo == 'HOMBRE')
            $request->merge(['sexo' => 'MASCULINO']);
        else if($request->sexo == 'MUJER')
            $request->merge(['sexo' => 'FEMENINO']);

        $estado = Cestado::select('descripcion')->where('id', $request->estado)->firstOrFail();
        $request->merge(['estado' => $estado->descripcion]);
        
  
        $pdf = PDF::loadView('contratoEmpleado', $request);

  
        return $pdf->setPaper('letter', 'portrait')->download('codingdriver.pdf');
    }

    public function uploadPhoto(Request $request)
    {
        if($request->validate(['foto' => 'required|image|mimes:jpeg,png,jpg']))
        {
            $file = $request->file('foto');
            $destinationPath = public_path('/images/fotosEmpleados/');
            $file->move($destinationPath, $request->nip.'.jpeg');
            return response()->json(true, 200);
        }
        else
            return response()->json(false, 200);
    }
}
