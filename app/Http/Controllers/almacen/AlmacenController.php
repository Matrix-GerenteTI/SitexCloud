<?php

namespace App\Http\Controllers\almacen;

use App\Exports\PoliticaPrecioExport;
use App\Http\Controllers\Controller;
use App\Models\Politica_precio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class AlmacenController extends Controller
{
    public function getFamilia()
    {  
        $respuesta = Http::get('http://servermatrixxxb.ddns.net/intranet/productos/getfamilias');
        $res = $respuesta->json();
        return response()->json($res, 200);
    }

    public function getSubfamilia($id)
    {  
        $respuesta = Http::get('http://servermatrixxxb.ddns.net/intranet/productos/getsubfamilias/'.$id);
        $res = $respuesta->json();
        return response()->json($res, 200);
    }

    public function getAllSubfamilias()
    {  
        $respuesta = Http::get('http://servermatrixxxb.ddns.net/intranet/productos/getallsubfamilias');
        $res = $respuesta->json();
        return response()->json($res, 200);
    }

    public function getAllPoliticaPrecios()
    {  
        $respuesta = Politica_precio::where('status', 1)->get()->toArray();
        return response()->json($respuesta, 200);
    }

    public function getPrecioPorFamilia($id)
    {  
        $respuesta = Politica_precio::where('familia', $id)->where('status', 1)->get()->toArray();
        return response()->json($respuesta, 200);
    }

    public function getPrecioPorSubfamilia(Request $request)
    {  
        if($request->filtroFamilia == "LLANTA")
        {
            $collection = [];
            $llantas = Politica_precio::where('familia', 'LLANTA')->orderby('subfamilia')->distinct()->get();
            for ($i=0; $i<count($llantas); $i++) 
            { 
                $contador = count($collection);
                $status = false;
                $subfamilia = $llantas[$i]->subfamilia;
                $explode = explode("/", $subfamilia);
                $rin = $explode[count($explode)-1];

                if($rin == $request->filtroSubfamilia)
                    array_push($collection, $llantas[$i]);
            }
            return response()->json($collection, 200);
        }
        else
        {
            $respuesta = Politica_precio::where('familia', $request->filtroFamilia)->where('subfamilia', $request->filtroSubfamilia)->where('status', 1)->get()->toArray();
            return response()->json($respuesta, 200);
        }   
    }

    public function savePrecio(Request $request)
    {  
        $existe = Politica_precio::where('familia', $request->familia)->where('subfamilia', $request->subfamilia)->where('status', 1)->exists();
        if($existe == true)
            return response()->json(false, 200);
        else
        {
            $precio = new Politica_precio();
            $precio->familia = $request->familia;
            $precio->subfamilia = $request->subfamilia;
            $precio->pvp1 = $request->pvp1;
            $precio->pvp2 = $request->pvp2;
            $precio->pvp3 = $request->pvp3;
            $precio->pvp4 = $request->pvp4;
            $precio->pvp5 = $request->pvp5;
            $precio->status = 1;
            $precio->save();
            return response()->json(true, 200);
        }
    }

    public function updateItemTabla(Request $request)
    {  
        Politica_precio::where('id', $request->id)->update(['pvp1'=>$request->pvp1, 'pvp2'=>$request->pvp2, 'pvp3'=>$request->pvp3, 'pvp4'=>$request->pvp4, 'pvp5'=>$request->pvp5]);
        return response()->json(true, 200);
    }

    public function borrarPrecio($id)
    {  
        Politica_precio::where('id', $id)->update(['status'=>99]);
        //$respuesta = Politica_precio::where('id', $id)->firstOrFail();
        //$respuesta->delete();
        return response()->json(true, 200);
    }

    public function getFiltroFamilia()
    { 
        $familia = Politica_precio::select('familia')->distinct()->get();
        return response()->json($familia, 200);
    }

    public function getFiltroSubfamilia($id)
    {  
        $subfamilia = Politica_precio::select('subfamilia')->where('familia', $id)->orderby('subfamilia')->distinct()->get();
        return response()->json($subfamilia, 200);
    }

    public function getllantas()
    {
        $collection = [];
        $llantas = Politica_precio::select('subfamilia')->where('familia', 'LLANTA')->orderby('subfamilia')->distinct()->get();
        for ($i=0; $i<count($llantas); $i++) 
        { 
            $contador = count($collection);
            $status = false;
            $subfamilia = $llantas[$i]->subfamilia;
            $explode = explode("/", $subfamilia);
            $rin = $explode[count($explode)-1];

            if($contador == 0)
            {
                $arraySubfamilia = array(
                    "subfamilia"    =>  $rin
                );
                array_push($collection, (object)$arraySubfamilia);
            }

            for ($j=0; $j<$contador; $j++) 
            { 
                if($collection[$j]->subfamilia != $rin )
                {
                    $status = true;
                }
                else
                {
                    $status = false;
                    break;
                }
            }
            if($status == true)
            {
                $arraySubfamilia = array(
                    "subfamilia"    =>  $rin,
                );
                array_push($collection, (object)$arraySubfamilia);
                asort($collection);
            }
        }
        return response()->json((array)$collection, 200);
    }    

    public function exportarExcelPoliticaPrecios(Request $request)
    {
        return Excel::download(new PoliticaPrecioExport($request), 'PoliticaPrecios.xlsx');
    }
}
