<?php

namespace App\Http\Controllers\Recursoshumanos;

use DateTime;
use App\Models\Pquizz;
use App\Models\Cquizznivel;
use Illuminate\Http\Request;
use App\Models\Cquizzpregunta;
use App\Models\Ctipodeduccion;
use App\Models\Ctipoincidencia;
use App\Models\Ctipopercepcion;
use App\Models\Ppagosdeducciones;
use App\Models\Cquizzsubcategoria;
use App\Models\Cquizzclasificacion;
use App\Models\Pincidenciasusuario;
use App\Models\Rusuario_incidencia;
use App\Http\Controllers\Controller;
use App\Models\Presguardo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RecursosHumanosController extends Controller
{
    public function getNivelquizz()
    {
        $nivel = Cquizznivel::where('status', 1)->get();
        return response()->json($nivel, 200);
    }

    public function getClasificacionquizz()
    {
        $clasificacion = Cquizzclasificacion::where('status', 1)->get();
        return response()->json($clasificacion, 200);
    }

    public function getSubcategoriaquizz()
    {
        $subcategoria = Cquizzsubcategoria::where('status', 1)->get();
        return response()->json($subcategoria, 200);
    }

    public function saveQuizzPregunta(Request $request)
    {
        $quizzPregunta = new Cquizzpregunta();
        $quizzPregunta->descripcion = strtoupper($request->pregunta);
        $quizzPregunta->idnivel = $request->nivel;
        $quizzPregunta->idclasificacion = $request->clasificacion;
        $quizzPregunta->idsubcategoria = $request->subcategoria;
        $quizzPregunta->status = 1;
        $quizzPregunta->save();
        
        return response()->json($quizzPregunta->id, 200);
    }

    public function saveQuizzRespuestas(Request $request)
    {
        $quizz = new Pquizz();
        $quizz->idPregunta = $request->pregunta;
        $quizz->respuestatxt = $request->restxt;
        $quizz->statuscorrecta = $request->correcta;
        $quizz->status = 1;
        $quizz->save();
        if($request->subcategoria == 2)
            Pquizz::where('id', $quizz->id)->update(['respuestaimage'=>'public/images/quizz/Respuestas/'.$quizz->id]);
            
        return response()->json($quizz->id, 200);
    }

    public function uploadFotos(Request $request)
    {
        Storage::disk('uploads')->makeDirectory('images/quizz/'.$request->name);
            $file = $request->file('foto');
            $destinationPath = public_path('/images/quizz/'.$request->name);

            $image_resize = Image::make($file);
            $image_resize->resize(800, 800, function($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'. $request->codigo.'.jpeg');
        return response()->json(true, 200);
    }

    public function getTipoIncidencia()
    {
        $tipos = Ctipoincidencia::where('status', 1)->get();
        return response()->json($tipos, 200);
    }

    public function getAccionIncidencias($id)
    {
        if($id == 1)
        {
            $deducciones = Ctipodeduccion::where('status', 1)->orderby('descripcion')->get();
            return response()->json($deducciones, 200);
        }
        else if($id == 2)
        {
            $percepciones = Ctipopercepcion::where('status', 1)->orderby('descripcion')->get();
            return response()->json($percepciones, 200);
        }
    }

    public function getAccionIncidenciasPorUsuario(Request $request)
    {
        if($request->idTipoMovimiento == 1)
        {
            $deducciones = Rusuario_incidencia::select('ctipodeduccion.id', 'ctipodeduccion.descripcion')->where('rusuario_incidencia.idempleado', $request->idEmpleado)->where('ctipodeduccion.status', 1)->where('rusuario_incidencia.status', 1)->join('ctipodeduccion', 'rusuario_incidencia.iddeduccion', '=', 'ctipodeduccion.id')->orderby('ctipodeduccion.descripcion')->get();
            return response()->json($deducciones, 200);
        }
        else if($request->idTipoMovimiento == 2)
        {
            $percepciones = Rusuario_incidencia::select('ctipopercepcion.id', 'ctipopercepcion.descripcion')->where('rusuario_incidencia.idempleado', $request->idEmpleado)->where('ctipopercepcion.status', 1)->where('rusuario_incidencia.status', 1)->join('ctipopercepcion', 'rusuario_incidencia.idpercepcion', '=', 'ctipopercepcion.id')->orderby('ctipopercepcion.descripcion')->get();
            return response()->json($percepciones, 200);
        }
    }

    public function guardarIncidencia(Request $request)
    {
        $incidencia = new Pincidenciasusuario();
        $incidencia->idempleado = $request->idempleado;
        $incidencia->idtipoincidencia = $request->idTipoMovimiento;
        $incidencia->idincidencia = $request->idincidencia;
        $incidencia->fecha = $request->fechaIncidencia;
        $incidencia->monto = $request->monto;
        $incidencia->numpagos = $request->cantidadPagos;
        $incidencia->fechaAplicar = $request->fechaAplicar;
        $incidencia->observaciones = $request->observaciones;
        $incidencia->status = 0;
        $incidencia->save();
        //Generar pagos de la incidencia
        /*if($request->parcialidades == 2)
        {
            $quincena = $request->fechaAplicar;
            for($i=0; $i<$request->cantidadPagos; $i++)
            {   
                $L = new DateTime($quincena);
                $fechaComoEntero = strtotime($quincena);
                $dia = date("d", $fechaComoEntero);
                
                $pagos = new Ppagosdeducciones();
                $pagos->idpincidenciasusuario = $incidencia->id;
                $pagos->monto = $request->monto/$request->cantidadPagos;
                $pagos->fechadepago = $quincena;
                $pagos->status = 0;
                $pagos->save();

                if($dia == 15)
                {
                    $quincena = $L->format( 'Y-m-t' );
                }
                else if($quincena == $L->format( 'Y-m-t' ))
                {
                    $quincena = date("Y-m-d",strtotime($L->format( 'Y-m-t' )."+ 15 days"));
                }
            }
            return response()->json(true, 200);
        }
        else if($request->parcialidades == 1)
        {
            $pagos = new Ppagosdeducciones();
            $pagos->idpincidenciasusuario = $incidencia->id;
            $pagos->monto = $request->monto;
            $pagos->fechadepago = $request->fechaAplicar;
            $pagos->status = 1;
            $pagos->save();
            return response()->json(true, 200);
        }
        else
        {
            return response()->json('Incidencia no almacenada', 200);
        }
        */
    }

    public function borrarIncidencia($id)
    {
        Pincidenciasusuario::where('id', $id)->update(['status'=> 99]);
        return response()->json(true, 200);
    }

    public function getAllDeducciones()
    {
        $allDeducciones = Pincidenciasusuario::select('pincidenciasusuario.id', 'pempleado.nombre', 'ctipoincidencia.descripcion AS Tipo', 'ctipodeduccion.descripcion', 'pincidenciasusuario.fecha', 'pincidenciasusuario.monto', 'pincidenciasusuario.numpagos','pincidenciasusuario.fechaAplicar', 'pincidenciasusuario.observaciones', 'pincidenciasusuario.status')
        ->join('dbnomina.pempleado AS pempleado', 'pincidenciasusuario.idempleado', '=', 'pempleado.nip')
        ->join('ctipoincidencia', 'pincidenciasusuario.idtipoincidencia', '=', 'ctipoincidencia.id')
        ->join('ctipodeduccion', 'pincidenciasusuario.idincidencia', '=', 'ctipodeduccion.id')
        ->where('pincidenciasusuario.idtipoincidencia', 1)->get();
        return response()->json($allDeducciones, 200);
    }
    
    public function getAllPercepciones()
    {
        $allPercepciones = Pincidenciasusuario::select('pincidenciasusuario.id', 'pempleado.nombre', 'ctipoincidencia.descripcion AS Tipo', 'ctipopercepcion.descripcion', 'pincidenciasusuario.fecha', 'pincidenciasusuario.monto', 'pincidenciasusuario.numpagos','pincidenciasusuario.fechaAplicar', 'pincidenciasusuario.observaciones', 'pincidenciasusuario.status')
        ->join('dbnomina.pempleado AS pempleado', 'pincidenciasusuario.idempleado', '=', 'pempleado.nip')
        ->join('ctipoincidencia', 'pincidenciasusuario.idtipoincidencia', '=', 'ctipoincidencia.id')
        ->join('ctipopercepcion', 'pincidenciasusuario.idincidencia', '=', 'ctipopercepcion.id')
        ->where('pincidenciasusuario.idtipoincidencia', 2)->get();
        return response()->json($allPercepciones, 200);
    }

    public function getPagos($id)
    {
        $pagos = Ppagosdeducciones::where('idpincidenciasusuario', $id)->get();
        return response()->json($pagos, 200);
    }

    public function getDeduccionesEmpleado()
    {
        $deducciones = Rusuario_incidencia::select('rusuario_incidencia.id', 'pempleado.nombre', 'ctipodeduccion.descripcion')
        ->join('dbnomina.pempleado AS pempleado', 'rusuario_incidencia.idempleado', '=', 'pempleado.nip')
        ->join('ctipodeduccion', 'rusuario_incidencia.iddeduccion', '=', 'ctipodeduccion.id')
        ->where('rusuario_incidencia.status', 1)->get();
        return response()->json($deducciones, 200);
    }

    public function getPercepcionesEmpleado()
    {
        $percepciones = Rusuario_incidencia::select('rusuario_incidencia.id', 'pempleado.nombre', 'ctipopercepcion.descripcion')
        ->join('dbnomina.pempleado AS pempleado', 'rusuario_incidencia.idempleado', '=', 'pempleado.nip')
        ->join('ctipopercepcion', 'rusuario_incidencia.idpercepcion', '=', 'ctipopercepcion.id')
        ->where('rusuario_incidencia.status', 1)->get();
        return response()->json($percepciones, 200);
    }

    public function getPreguntasfiltrosQuizz(Request $request)
    {
        if($request->categoria == 0 && $request->nivel == 0 && $request->subcategoria == 0)
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
        else if($request->categoria == 0 && $request->nivel == 0)
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.idsubcategoria', $request->subcategoria)
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
        else if($request->nivel == 0 && $request->subcategoria == 0)
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.idclasificacion', $request->categoria)
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
        else if($request->categoria == 0 && $request->subcategoria == 0)
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.idnivel', $request->nivel)
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
        else if($request->categoria == 0)
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.idnivel', $request->nivel)
            ->where('cquizzpregunta.idsubcategoria', $request->subcategoria)
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
        else if($request->nivel == 0)
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.idclasificacion', $request->categoria)
            ->where('cquizzpregunta.idsubcategoria', $request->subcategoria)
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
        else if($request->subcategoria == 0)
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.idnivel', $request->nivel)
            ->where('cquizzpregunta.idclasificacion', $request->categoria)
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
        else
        {
            $preguntas = Cquizzpregunta::select('cquizzpregunta.id', 'cquizzclasificacion.descripcion AS clasificacion', 
            'cquizznivel.descripcion AS nivel', 'cquizzsubcategoria.descripcion AS tipo', 'cquizzpregunta.descripcion AS pregunta')
            ->join('cquizzclasificacion', 'cquizzpregunta.idclasificacion', '=', 'cquizzclasificacion.id')
            ->join('cquizznivel', 'cquizzpregunta.idnivel', '=', 'cquizznivel.id')
            ->join('cquizzsubcategoria', 'cquizzpregunta.idsubcategoria', '=', 'cquizzsubcategoria.id')
            ->where('cquizzpregunta.idnivel', $request->nivel)
            ->where('cquizzpregunta.idclasificacion', $request->categoria)
            ->where('cquizzpregunta.idsubcategoria', $request->subcategoria)
            ->where('cquizzpregunta.status', 1)->get();
            return response()->json($preguntas, 200);
        }
    }

    public function verRespuestasQuizz($id)
    {
        $collectionId = [];
        $tipo = Cquizzpregunta::select('idsubcategoria')->where('id', $id)->get();
        if($tipo[0]->idsubcategoria == 2)
        {
            $respuestas = Pquizz::select('respuestaimage AS respuesta', 'statuscorrecta AS estado')->where('idpregunta', $id)->get();
            for($i=0; $i<count($respuestas); $i++)
            {
                $explode = explode("/", $respuestas[$i]->respuesta);
                $idImage = $explode[count($explode)-1];

                $array = array(
                    "respuesta" => $idImage,
                    "estado" => $respuestas[$i]->estado,
                    "tipo"  => $tipo[0]->idsubcategoria
                );
                array_push($collectionId, (object)$array);
            }
            return response()->json($collectionId, 200);
        }
        else
        {
            $respuestas = Pquizz::select('respuestatxt AS respuesta', 'statuscorrecta AS estado', 'respuestaimage AS tipo')->where('idpregunta', $id)->get();
            return response()->json($respuestas, 200);
        }
        
    }

    public function saveResguardo(Request $request)
    {
        
        if(Presguardo::where('id', $request->idAnterior)->where('status', 1)->exists() == true)
            Presguardo::where('id', $request->idAnterior)->update(['status'=>99]);
            
        $resguardo = new Presguardo();
        $resguardo->nip = $request->nip;
        $resguardo->nombre = $request->empleado;
        $resguardo->telefono = $request->telefono;
        $resguardo->direccion = $request->direccion;
        $resguardo->idcsucursal = $request->sucursal;
        $resguardo->idcdepartamento = $request->departamento;
        $resguardo->idcpuesto = $request->puesto;
        $resguardo->idequipo = $request->equipoComputo;
        $resguardo->fecha = $request->fecha;
        $resguardo->marca = strtoupper($request->marca);
        $resguardo->modelo = strtoupper($request->modelo);
        $resguardo->serie = strtoupper($request->serie);
        $resguardo->sisoperativo = strtoupper($request->sistemaoperativo);
        $resguardo->procesador = strtoupper($request->procesador);
        $resguardo->discoduro = $request->discoduro;
        $resguardo->memoriaram = $request->memoriaram;
        $resguardo->estado = strtoupper($request->estado);
        $resguardo->pathfotos = "XXXXXXX";
        $resguardo->observacionesentrega = strtoupper($request->observaciones);
        $resguardo->status = 1;
        $resguardo->save();
        Presguardo::where('id', $resguardo->id)->update(['pathfotos'=>'public/images/resguardos/'.$resguardo->id]);
        return response()->json($resguardo->id, 200);
    }

    public function uploadPhotosResguardos(Request $request)
    {
        Storage::disk('uploads')->makeDirectory('images/resguardos/'.$request->name);

        $file = $request->file('foto');
        $destinationPath = public_path('/images/resguardos/'.$request->name);

        $image_resize = Image::make($file);
        $image_resize->resize(800, 800, function($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'. $request->codigo.'.jpeg');

        return response()->json(true, 200);
    }

    public function getResguardos($nip)
    {
        $resguardo = Presguardo::select('presguardos.id', 'csucursal.descripcion AS sucursal', 'csubcategoria.nombreSubcategoria AS equipo', 
        'presguardos.idequipo', 'presguardos.marca', 'presguardos.modelo', 'presguardos.serie', 'presguardos.fecha')
        ->join('csucursal', 'presguardos.idcsucursal', '=', 'csucursal.id')
        ->join('csubcategoria', 'presguardos.idequipo', '=', 'csubcategoria.id')->where('nip', $nip)->where('presguardos.status', 1)->get();
        return response()->json($resguardo, 200);
    }

    public function borrarResguardo($id)
    {
        $fecha = new DateTime();
        Presguardo::where('id', $id)->update(['status'=>99]);
        Presguardo::where('id', $id)->update(['observacionesdevolucion'=>'SE LE ELIMINÓ EL EQUIPO DE COMPUTO AL EMPLEADO']);
        Presguardo::where('id', $id)->update(['fechadevolucion'=> $fecha->format('Y-m-d H:i:s')]);
        Presguardo::where('id', $id)->update(['usuariocheck'=>Auth::user()->nombre]);
        return response()->json(true, 200);
    }

    public function imprimirResguardo(Request $request)
    {
        $formatos = ['jpg','jpeg'];
        $checkFoto = false;
            foreach ($formatos as $formato) 
            {
                $path = public_path("../../intranet/Empresa/foto_empleado/".$request->nip.".".$formato);
                if(File::exists($path) == true)
                {
                    $request->merge(['fotoEmpleado' => "intranet/Empresa/foto_empleado/".$request->nip.".".$formato]);
                    $checkFoto = true;
                    break;
                }
            }
            if($checkFoto == false)
                $request->merge(['fotoEmpleado' => "matrix/public/images/person.png"]);

        //setlocale(LC_TIME, "spanish");
        setlocale(LC_ALL, 'es_CO.UTF-8');
        $fecha = strftime("%d de %B de %Y", strtotime(date('d-m-Y')));
        $request->merge(['fecha' => $fecha]);
        $request->merge(['admin' => Auth::user()->nombre]);

        $resguardos = Presguardo::select('presguardos.id', 'csucursal.descripcion AS sucursal', 'csubcategoria.nombreSubcategoria AS equipo', 
        'presguardos.idequipo', 'presguardos.marca', 'presguardos.modelo', 'presguardos.serie', 'presguardos.fecha', 'presguardos.estado', 'presguardos.observacionesentrega AS observaciones')
        ->join('csucursal', 'presguardos.idcsucursal', '=', 'csucursal.id')
        ->join('csubcategoria', 'presguardos.idequipo', '=', 'csubcategoria.id')->where('nip', $request->nip)->where('presguardos.status', 1)->get();
        
        $request->merge(['resguardos' => $resguardos]);

        //$puesto = Cpuesto::select('descripcion')->where('id', $request->puesto)->firstOrFail();
        //$request->merge(['puesto' => $puesto->descripcion]);

        //$estado = Cestado::select('descripcion')->where('id', $request->estado)->firstOrFail();
        //$request->merge(['estado' => $estado->descripcion]);
        
        $pdf = PDF::loadView('resguardoEmpleado', $request);

        return $pdf->setPaper('letter', 'portrait')->download('codingdriver.pdf');
    }

    public function verFotosResguardos($id)
    {
        $total_imagenes = count(glob('images/resguardos/'.$id.'/{*.jpeg,*.gif,*.png}',GLOB_BRACE));
        $arrFiles = glob('images/resguardos/'.$id.'/*.jpeg');
        return response()->json($arrFiles, 200);
    }
}
