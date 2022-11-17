<?php

namespace App\Http\Controllers\Cavim;

use App\Exports\BonoChoferesExport;
use App\Exports\CavimExport;
use App\Models\Pcavim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cautos_modelo;
use App\Models\Pbonochoferes;
use App\Models\Pcontrato;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CavimController extends Controller
{
    public function borrarRegistro($folio)
    {
        $registro = Pcavim::where('prediction_folio', $folio)->firstOrFail();
        $registro->delete();
        return response()->json(true, 200);
    }

    public function guardarVehiculo(Request $request)
    {
        $new = new Cautos_modelo();
        $new->modelo = strtoupper($request->modelo);
        $new->modelo_anio = $request->anio;
        $new->version = strtoupper($request->version);
        $new->tipo_carro = $request->tipo;
        $new->tipo_rin = "alloy";
        $new->idmarca = $request->marca;
        $new->tyres_specs_id = 0;
        $new->status = 1;
        $new->save();
        return response()->json(true, 200);
    }

    public function registrar(Request $request)
    {
        $registro = new Pcavim();
        $registro->idsucursal = $request->input('sucursal');
        $registro->idautos_modelo = $request->input('linea');
        $registro->color = strtoupper($request->input('color'));
        $registro->fecha = $request->input('fecha');
        $registro->hora = $request->input('hora');
        $registro->telefono = $request->input('telefono');
        $registro->fechai = $request->input('fechaEntrada');
        $registro->horai = $request->input('horaEntrada');
        $registro->fechaf = $request->input('fechaSalida');
        $registro->horaf = $request->input('horaSalida');
        $registro->prediction_id = $request->input('prediction_id');
        $registro->prediction_folio = $request->input('folio');
        $registro->prediction_idvendedor = $request->input('prediction_idvendedor');
        $registro->prediction_vendedor = $request->input('vendedor');
        $registro->prediction_total = $request->input('prediction_total');
        $registro->prediction_fecha = $request->input('fechaTicket');
        $registro->prediction_hora = $request->input('horaTicket');
        $registro->status = $request->input('status');
        $registro->save();
        return response()->json(true, 200);
    }

    public function exportarExcel($fecha)
    {  
        $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/cavim/getTicketsAll/'.$fecha);
        $res = $respuesta->json();
        $res2 = $res[0];
        $getdatos = Pcavim::select('cautos_marca.marca', 'cautos_modelo.modelo', 'color', 'telefono', 'prediction_id')->join('cautos_modelo', 'pcavim.idautos_modelo', '=', 'cautos_modelo.id')->join('cautos_marca', 'cautos_modelo.idmarca' , '=', 'cautos_marca.id')->where('prediction_fecha', $fecha)->get();
            $finalArray = array();
            $newArrayApi = array();
            for($i= 0; $i<count($getdatos); $i++){
                $idFolio = $getdatos[$i]->prediction_id;
                if(array_key_exists($idFolio, $res2) == true)
                    array_push($newArrayApi, $res2[$idFolio]);}

            for($j=0; $j<count($newArrayApi); $j++){
                $index = $newArrayApi[$j];
                $cabecera = array();
                $cabecera = $index['cabecera'];
                
                for($a=0; $a<count($newArrayApi); $a++)
                {
                    $idPedido = $getdatos[$a]->prediction_id;
                    if($idPedido == $cabecera['idpedido'])
                        break;
                }
                $detalle = array();
                $detalle = $index['detalle'];

                if($cabecera['tipo'] == 'CREDITO')
                {
                    array_push($finalArray, $index['cabecera']);
                }
                else
                {
                    for($k=0; $k<count($detalle); $k++)
                    {
                        $importe = $detalle[$k];
                        if($importe['IMPORTE']>0 )
                        {
                            $getcavim = $getdatos->where('prediction_id', $idPedido);
                            $cavimArray = array();
                            $cavimArray = $getcavim->first()->toArray();
                            $arrayUnion = array();
                            $arrayUnion = array_merge($cabecera, $detalle[$k], $cavimArray);
                            array_push($finalArray, $arrayUnion);
                        }
                    }
                }
            }
            //dd($finalArray);
        return Excel::download(new CavimExport($fecha, $finalArray), 'CAVIM.xlsx');
        //return response()->json($finalArray, 200);
    }

    public function getChoferes()
    {
        $choferes = Pcontrato::select('pempleado.nip', 'pempleado.nombre', 'pempleado.idsucursal')->where('idpuesto', 87)
        ->join('pempleado', 'pcontrato.nip', '=', 'pempleado.nip')->where('pempleado.status', 1)->get();
        return response()->json($choferes, 200);
    }

    public function saveBonoChofer(Request $request)
    {
        $bono = new Pbonochoferes();
        $bono->nip = $request->idChofer;
        $bono->idsucursal = $request->sucursal;
        $bono->fecha = $request->fecha;
        $bono->pathfoto = "---";
        $bono->asistencia = $request->asistencia;
        $bono->puntualidad = $request->puntualidad;
        $bono->uniforme = $request->uniforme;
        $bono->status = 1;
        $bono->save();
        Pbonochoferes::where('id', $bono->id)->update(['pathfoto'=>'public/images/cavim/bonoChoferes/'.$bono->id]);
        return response()->json($bono->id, 200);
    }

    public function uploadFotoBono(Request $request)
    {
        Storage::disk('uploads')->makeDirectory('images/cavim/'.$request->name);
        $file = $request->file('foto');
        $destinationPath = public_path('/images/cavim/'.$request->name);

        $image_resize = Image::make($file);
        $image_resize->resize(800, 800, function($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'. $request->codigo.'.jpeg');
        return response()->json(true, 200);
    }

    public function getBonosChoferesFiltros(Request $request)
    {
        if($request->chofer == 0)
        {
            $registros = Pbonochoferes::select('pbonochoferes.id', 'csucursal.descripcion', 'pbonochoferes.fecha', 'pempleado.nombre', 'pbonochoferes.asistencia', 'pbonochoferes.puntualidad', 'pbonochoferes.uniforme', 'pbonochoferes.pathfoto')
            ->join('dbnomina.pempleado', 'pbonochoferes.nip', '=', 'pempleado.nip')
            ->join('csucursal', 'pbonochoferes.idsucursal', '=', 'csucursal.id')
            ->whereBetween('pbonochoferes.fecha', [$request->fechaInicial, $request->fechaFinal])
            ->where('pbonochoferes.status', 1)->orderby('pbonochoferes.fecha')->get();
            return response()->json($registros, 200);
        }
        else{
            $registros = Pbonochoferes::select('pbonochoferes.id', 'csucursal.descripcion', 'pbonochoferes.fecha', 'pempleado.nombre', 'pbonochoferes.asistencia', 'pbonochoferes.puntualidad', 'pbonochoferes.uniforme', 'pbonochoferes.pathfoto')
            ->join('dbnomina.pempleado', 'pbonochoferes.nip', '=', 'pempleado.nip')
            ->join('csucursal', 'pbonochoferes.idsucursal', '=', 'csucursal.id')
            ->whereBetween('pbonochoferes.fecha', [$request->fechaInicial, $request->fechaFinal])
            ->where('pbonochoferes.nip', $request->chofer)->where('pbonochoferes.status', 1)->orderby('pbonochoferes.fecha')->get();
            return response()->json($registros, 200);
        }
    }

    public function exportarExcelBonoChoferes(Request $request)
    {
        return Excel::download(new BonoChoferesExport($request), 'PoliticaPrecios.xlsx');
    }
}
