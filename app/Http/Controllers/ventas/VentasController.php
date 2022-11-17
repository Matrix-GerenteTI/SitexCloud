<?php

namespace App\Http\Controllers\ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class VentasController extends Controller
{
    public function getTicketsFacturacion(Request $request)
    {
        $fechaInicial = substr($request->fechainicial,8,2).'.'.substr($request->fechainicial,5,2).'.'.substr($request->fechainicial,0,4);
        $fechaFinal = substr($request->fechafinal,8,2).'.'.substr($request->fechafinal,5,2).'.'.substr($request->fechafinal,0,4);

        if($request->cliente == 0)
            {$request->cliente = '%';}
        if($request->almacen == 0)
            {$request->almacen = '%';}
        

        $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/sitexcloud/facturacion/getTicketsFiltro/'
        .$request->cliente.'/'.$request->almacen.'/'.$fechaInicial.'/'.$fechaFinal.'/'.$request->formapago);
        $res = $respuesta->json();
        //return $respuesta;
        return response()->json($res[0], 200);
        //return $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/sitexcloud/facturacion/getTicketsFiltro/'
        //.$request->cliente.'/'.$request->almacen.'/'.$fechaInicial.'/'.$fechaFinal.'/'.$request->formapago);
    }

    public function getTicketAnticipo($id)
    {
        $respuesta = Http::get('http://servermatrixxxb.ddns.net:8181/intranet/sitexcloud/facturacion/getAnticiposLiq/'.$id);
        $res = $respuesta->json();
        return response()->json($res, 200);
    }
}
