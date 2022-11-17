<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithStyles;

class BonoChoferesExport implements FromCollection, WithHeadings, WithColumnWidths, WithDrawings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(object $data) 
    {
        $this->data = $data;
        
        //unset($this->data[0]->id);
    }

    public function collection()
    {
        $collection = [];
        for ($i=0; $i<count($this->data->all()) ; $i++) 
        { 
            $array = $this->data[$i];
            unset($array['id']);
            unset($array['pathfoto']);
            if($array['asistencia'] == 1)
                $array['asistencia'] = "SI";
            else if($array['asistencia'] != 1)
                $array['asistencia'] = "NO";
            if($array['puntualidad'] == 1)
                $array['puntualidad'] = "SI";
            else if($array['puntualidad'] != 1)
                $array['puntualidad'] = "NO";
            if($array['uniforme'] == 1)
                $array['uniforme'] = "SI";
            else if($array['uniforme'] != 1)
                $array['uniforme'] = "NO";
                
            array_push($collection, $array);
        }
        return collect($collection);
    }

    public function headings():array
    {
        return[
            ['  '],
            ['  '],
            ['  '],
            ['  '],
            ['  '],
            ['  '],
            [' REGISTROS DE BONO DE CHOFERES'],
            ['  '],
            ['SUCURSAL',
            'FECHA',
            'CHOFER',
            'ASISTENCIA',
            'PUNTUALIDAD',
            'UNIFORME',
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22,
            'B' => 15,
            'C' => 35,     
            'D' => 12,  
            'E' => 14,  
            'F' => 12,         
        ];
    }
    public function styles(Worksheet $sheet)
    {
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ];
            $sheet->getStyle('A9:F9')->applyFromArray($styleArray);

        return [
            7    => ['font' => ['bold' => true]],
        ];  
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('images/logoMatrix.png'));
        $drawing->setHeight(100);
        $drawing->setCoordinates('A1');

        return [$drawing];
    }
}
