<?php

namespace App\Exports;

use App\Models\Politica_precio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PoliticaPrecioExport implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(object $data) 
    {
        $this->familia = $data->filtroFamilia;
        $this->subfamilia = $data->filtroSubfamilia;
    }
    public function collection()
    {
        if($this->familia == "TODOS" && $this->subfamilia == "")
        {
            return Politica_precio::select('familia', 'subfamilia', 'pvp1', 'pvp2', 'pvp3', 'pvp4', 'pvp5')->where('status', 1)->get(); 
        }
        else if($this->subfamilia == "")
        {
            return Politica_precio::select('familia', 'subfamilia', 'pvp1', 'pvp2', 'pvp3', 'pvp4', 'pvp5')->where('status', 1)
            ->where('familia', $this->familia)->get();
        }
        else
        {
            $collection = collect();
            $llantas = Politica_precio::select('familia' ,'subfamilia', 'pvp1', 'pvp2', 'pvp3', 'pvp4', 'pvp5')->where('familia', 'LLANTA')->orderby('subfamilia')->distinct()->get();
            for ($i=0; $i<count($llantas); $i++) 
            { 
                $subfamilia = $llantas[$i]->subfamilia;
                $explode = explode("/", $subfamilia);
                $rin = $explode[count($explode)-1];

                if($this->subfamilia == $rin)
                {
                    $collection->push($llantas[$i]);
                }
            }
            return $collection;
        }
        
    }

    public function headings():array
    {
        return[
            'FAMILIA',
            'SUBFAMILIA',
            'PVP1',
            'PVP2',
            'PVP3',
            'PVP4',
            'PVP5',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22,
            'B' => 18,
            'C' => 15,     
            'D' => 15,  
            'E' => 15,  
            'F' => 15, 
            'G' => 15,          
        ];
    }
}
