<?php

namespace App\Exports;

use App\Models\Pactivofijos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class ActivosFijosExport implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(object $data) 
    {
        $this->data = $data;

    }
    public function collection()
    {
        return $this->data; 
    }

    public function headings():array
    {
        return[
            'ID',
            'SUCURSAL',
            'CATEGORIA',
            'SUBCATEGORIA',
            'MARCA',
            'MODELO',
            'NUMERO DE SERIE',
            'CANTIDAD',
            'COSTO',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 22,
            'C' => 18,     
            'D' => 25,  
            'E' => 18,  
            'F' => 18, 
            'G' => 20,  
            'H' => 11,  
            'I' => 11         
        ];
    }
}
