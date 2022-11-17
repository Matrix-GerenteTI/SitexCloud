<?php

namespace App\Exports;

use App\Models\Pcavim;
use App\Models\Csucursal;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CavimExport implements WithMultipleSheets
{
    protected $fecha;
    protected $finalArray;

    public function __construct(string $fecha, array $finalArray)
    {
        $this->fecha = $fecha;
        $this->finalArray = $finalArray;
    }

    public function sheets(): array
    {
        //dd($this->finalArray);
        $sheets = [];
        $sucursales = Csucursal::select('id', 'descripcion', 'idprediction')->where('status', 1)->get();
        $total = $sucursales->count();

        for($m=0; $m<$total; $m++)
        {
            $Efectivo = 0;
            $TDC = 0;
            $TDB = 0;
            $Transfer = 0;
            $Anticipo = 0;
            $excelArray = array();
            $sucursal = $sucursales[$m]->idprediction;

            for($n=0; $n<count($this->finalArray); $n++)
            {
                $ticket = $this->finalArray[$n];
                $idsucursal = $ticket['sucursalid'];
                if($idsucursal == $sucursal)
                {
                    if($ticket['tipo'] == 'CONTADO')
                    {
                        $formaPago = $ticket['FORMAPAGO'];
                        $importe = $ticket['IMPORTE'];
                        switch($formaPago)
                        {
                            case 'EFECTIVO#01': 
                                $Efectivo = $Efectivo + $importe;
                            break;  
                            case 'T.CRED#04': 
                                $TDC = $TDC + $importe;
                            break;
                            case 'T.DEB#28': 
                                $TDB = $TDB + $importe;
                            break;
                            case 'TRANSFER#03': 
                                $Transfer = $Transfer + $importe;
                            break;
                            case 'ANTICIPO': 
                                $Anticipo = $Anticipo + $importe;
                            break;
                        }
                    }
                    unset($ticket['idpedido'],$ticket['sucursalid'],$ticket['sucursal'],$ticket['vendedorid'],$ticket['fecha'],$ticket['REFERENCIA'],$ticket['prediction_id']);
                    array_push($excelArray, $ticket);
                }
            }
            
            if(empty($excelArray) == false) //Si trae elementos, se crea
            {
                $nameSucursal = $sucursales[$m]->descripcion;
                $sheets[] = new CavimSucursalSheet($excelArray, $nameSucursal, $this->fecha, $Efectivo, $TDC, $TDB, $Transfer, $Anticipo);
            }
        }

        return $sheets;
    }
}
