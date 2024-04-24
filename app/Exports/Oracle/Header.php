<?php

namespace App\Exports\Oracle;

use App\Models\Oracle\Invoice;
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

        $rows = Invoice::latest('creation_date')
            ->when($this->request->created_at, function ($query) {
                $period = explode('-', $this->request->created_at);
                $query->whereYear('creation_date', $period[0])->whereMonth('creation_date', $period[1]);
            })
            ->when($this->request->invoice_date, function ($query) {
                $period = explode('-', $this->request->invoice_date);
                $query->whereYear('ap_invoice_date', $period[0])->whereMonth('ap_invoice_date', $period[1]);
            })
            ->when($this->request->posting_date, function ($query) {
                $period = explode('-', $this->request->posting_date);
                $query->whereYear('ap_gl_date', $period[0])->whereMonth('ap_gl_date', $period[1]);
            })
            ->when($this->request->payment_method_lookup_code, function ($query) {
                $query->whereIn('payment_method_lookup_code', $this->request->payment_method_lookup_code);
            })
            ->when($this->request->status, function ($query) {
                $query->whereIn('status', $this->request->status);
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
                $event->sheet->getStyle('H' . ($this->firstRow + 1) . ':H' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
                $event->sheet->getStyle('I' . ($this->firstRow + 1) . ':I' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
                $event->sheet->getStyle('J' . ($this->firstRow + 1) . ':J' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
                $event->sheet->getStyle('M' . ($this->firstRow + 1) . ':M' . $event->sheet->getHighestRow())->getNumberFormat()->setFormatCode('yyyy-mm-dd');
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => '#,##0'
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
