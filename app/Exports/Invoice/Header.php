<?php

namespace App\Exports\Invoice;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Header implements FromView, WithStyles, WithEvents, ShouldAutoSize, WithColumnFormatting
{
    private $firstRow = 6;

    private $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $name = str(ltrim(strrchr(__NAMESPACE__, '\\'), '\\'))->kebab();

        $rows = Invoice::latest()
            ->when($this->request->document_status, function ($query) {
                $query->whereIn('document_status', $this->request->document_status);
            })
            ->when($this->request->approval_status, function ($query) {
                $query->whereIn('approval_status', $this->request->approval_status);
            })
            ->when($this->request->posting_date, function ($query) {
                $period = explode('-', $this->request->posting_date);
                $query->whereYear('posting_date', $period[0])->whereMonth('posting_date', $period[1]);
            })
            ->when($this->request->data_type, function ($query) {
                $query->whereHas('expense', function ($query) {
                    $query->whereIn('type', $this->request->data_type);
                });
            })
            ->get();

        return view("excel.{$name}.header", [
            'rows' => $rows,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $workSheet = $event->sheet->getDelegate();
                $workSheet->freezePane('A' . $this->firstRow + 1);
                $workSheet->setAutoFilter("A{$this->firstRow}:{$event->sheet->getHighestColumn()}{$this->firstRow}");
                $event->sheet->getStyle('I' . ($this->firstRow + 1) . ':I' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
                $event->sheet->getStyle('J' . ($this->firstRow + 1) . ':J' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
                $event->sheet->getStyle('K' . ($this->firstRow + 1) . ':K' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => '#,##0',
            'E' => '#,##0'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '3c3c3c'],
                ],
            ],
            'font' => ['bold' => true],
        ];

        $styleThinArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
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

        $sheet->getStyle("B{$this->firstRow}:B" . $sheet->getHighestRow())->getAlignment()->setVertical('center')->setHorizontal('left');
    }
}
