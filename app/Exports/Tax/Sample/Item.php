<?php

namespace App\Exports\Tax\Sample;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Item implements FromView, WithTitle, WithStyles, WithEvents, WithColumnFormatting, WithColumnWidths
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
        return 'Item';
    }

    public function view(): View
    {
        $page = str($this->page)->kebab();
        return view("excel.{$page}.sample.item");
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 30,
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

        $validation = $sheet->getCell('C2')->getDataValidation();
        $validation->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
        $validation->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Input type error');
        $validation->setError('Item must be exist on type data');
        $validation->setPromptTitle('Pick from type list');
        $validation->setPrompt('Please pick a value from the type list.');
        $validation->setFormula1('\'Reference - Type\'!$A$2:$A$5');
        $validation->setSqref('C2:D1048576');
    }
}
