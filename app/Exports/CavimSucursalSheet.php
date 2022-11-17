<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CavimSucursalSheet implements WithTitle, FromArray, WithHeadings, WithDrawings, WithStyles, WithColumnWidths, WithHeadingRow
{
    protected $foliosXsucursal;
    private $nameSucursal;
    private $fecha;
    private $Efectivo;
    private $TDC;
    private $TDB;
    private $Transfer;
    private $Anticipo;

    public function __construct(array $foliosXsucursal, string $nameSucursal, string $fecha, int $Efectivo, int $TDC, int $TDB, int $Transfer, int $Anticipo)
    {
        $this->foliosXsucursal = $foliosXsucursal;
        $this->nameSucursal  = $nameSucursal;
        $this->fecha  = $fecha;
        $this->Efectivo = $Efectivo;
        $this->TDC = $TDC;
        $this->TDB = $TDB;
        $this->Transfer = $Transfer;
        $this->Anticipo = $Anticipo;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 13,
            'B' => 13,
            'C' => 34,     
            'D' => 10,  
            'E' => 11,  
            'F' => 30, 
            'G' => 13,  
            'H' => 11,  
            'I' => 15,  
            'J' => 15,  
            'K' => 15,
            'L' => 15,          
        ];
    }

    public function headings(): array
    {
        return[
            ['  '],
            ['  '],
            ['  '],
            ['  '],
            ['  '],
            ['  '],
            [' REGISTROS DE LA SUCURSAL '.$this->nameSucursal.' del dia '.$this->fecha],
            ['  '],
            ['TIPO',
            'FOLIO',
            'VENDEDOR',
            'HORA',
            'TOTAL',
            'CLIENTE',
            'F/PAGO',
            'PAGO',
            'MARCA',
            'LINEA',
            'COLOR',
            'TELEFONO',
            ]
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

        /*$drawing2 = new Drawing();
        $drawing2->setName('Other image');
        $drawing2->setDescription('This is a second image');
        $drawing2->setPath(public_path('images/logoLeon.png'));
        $drawing2->setHeight(90);
        $drawing2->setCoordinates('F1');*/

        return [$drawing];
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
            $sheet->getStyle('A9:L9')->applyFromArray($styleArray);

            $styleArray2 = [
                'numberFormat' => [
                    'formatCode' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
                    ]
                ];
            $sheet->getStyle('E')->applyFromArray($styleArray2);
            $sheet->getStyle('H')->applyFromArray($styleArray2);
            $sheet->getStyle('G2:G6')->applyFromArray($styleArray2);

            $sheet->setCellValue('F2', 'EFECTIVO#01');
            $sheet->setCellValue('F3', 'T.CRED#04');
            $sheet->setCellValue('F4', 'T.DEB#28');
            $sheet->setCellValue('F5', 'TRANSFER#03');
            $sheet->setCellValue('F6', 'ANTICIPO');

            $sheet->getStyle('F2:F6')->getFont()->setBold(true);
            $sheet->getStyle('G2:G6')->getFont()->setBold(true);

            $sheet->setCellValue('G2', $this->Efectivo);
            $sheet->setCellValue('G3', $this->TDC);
            $sheet->setCellValue('G4', $this->TDB);
            $sheet->setCellValue('G5', $this->Transfer);
            $sheet->setCellValue('G6', $this->Anticipo);

            //$sheet->getCell('A2')->setValue("hello\nworld");
        return [
            // Style the first row as bold text.
            7    => ['font' => ['bold' => true]],
            
            // Styling a specific cell by coordinate.
            //'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            //'B'  => ['font' => ['size' => 16]],
        ];  
    }

    public function array(): array
    {
        return $this->foliosXsucursal;
        ['  '];
    }

    public function title(): string
    {
        return $this->nameSucursal;
    }
}
