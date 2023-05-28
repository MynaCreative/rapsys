<?php

namespace App\Exports\Expense;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Resource implements FromView, WithStyles, WithEvents, ShouldAutoSize
{
    private $rows;

    private $firstRow = 6;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function view(): View
    {
        $name = str(ltrim(strrchr(__NAMESPACE__, '\\'), '\\'))->kebab();

        return view("excel.{$name}.resource", [
            'rows' => $this->rows,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $workSheet = $event->sheet->getDelegate();
                $workSheet->freezePane('A' . $this->firstRow + 1);
                $workSheet->setAutoFilter("A{$this->firstRow}:{$event->sheet->getHighestColumn()}{$this->firstRow}");
                $event->sheet->getStyle('H' . ($this->firstRow + 1) . ':H' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '3c3c3c'],
                ],
            ],
            'font' => ['bold' => true],
        ];

        $styleThinArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '3c3c3c'],
                ],
            ],
        ];

        $sheet->getStyle("A{$this->firstRow}:{$sheet->getHighestColumn()}{$this->firstRow}")
            ->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ffd700');

        $sheet->getStyle("A{$this->firstRow}:{$sheet->getHighestColumn()}{$this->firstRow}")->applyFromArray($styleArray);
        $sheet->getStyle("A{$this->firstRow}:A" . $sheet->getHighestRow())->getAlignment()->setVertical('center')->setHorizontal('center');

        $lastColumn = $sheet->getHighestColumn();
        $lastColumn++;

        for ($column = 'A'; $column !== $lastColumn; $column++) {
            $sheet->getStyle("{$column}{$this->firstRow}:{$column}" . $sheet->getHighestRow())->applyFromArray($styleThinArray);
        }
    }
}
