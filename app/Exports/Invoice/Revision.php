<?php

namespace App\Exports\Invoice;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Revision implements FromView, WithStyles, WithEvents, ShouldAutoSize
{
    private $rows;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function view(): View
    {
        $name = str(ltrim(strrchr(__NAMESPACE__, '\\'), '\\'))->kebab();

        return view("excel.{$name}.revision", [
            'rows' => $this->rows,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 30,
            'D' => 30,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '#',
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $firstRow   = 1;
                $workSheet  = $event->sheet->getDelegate();
                $workSheet->freezePane('A' . $firstRow + 1);
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

        for ($column = 'A'; $column !== $lastColumn; $column++) {
            $sheet->getStyle("{$column}{$firstRow}:{$column}" . $sheet->getHighestRow())->applyFromArray($styleThinArray);
        }
    }
}
