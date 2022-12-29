<?php

namespace App\Exports\Withholding\Sample;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Type implements FromView, WithTitle, WithStyles, WithEvents, WithColumnFormatting, WithColumnWidths
{
    protected $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reference - Type';
    }

    public function view(): View
    {
        $page = str($this->page)->kebab();
        return view("excel.{$page}.sample.type");
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
        ];
    }

    public function columnFormats(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $firstRow   = 1;
                $workSheet  = $event->sheet->getDelegate();
                $workSheet->freezePane('A'.$firstRow+1);
            }
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $firstRow = 1;
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '3c3c3c'],
                ],
            ],
            'font' => ['bold' => true, 'color' => ['rgb' => 'ffffff']],
        ];

        $styleThinArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '3c3c3c'],
                ],
            ],
        ];

        $sheet->getStyle("A{$firstRow}:{$sheet->getHighestColumn()}{$firstRow}")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('c9a73d');
        $sheet->getStyle("A{$firstRow}:{$sheet->getHighestColumn()}{$firstRow}")->applyFromArray($styleArray);

        $lastColumn = $sheet->getHighestColumn();
        $lastColumn++;

        for ($column = 'A'; $column !== $lastColumn; $column++){
            $sheet->getStyle("{$column}{$firstRow}:{$column}".$sheet->getHighestRow())->applyFromArray($styleThinArray);
        }
    }
}
