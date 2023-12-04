<?php

namespace App\Exports\Invoice;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RevisionAll implements WithMultipleSheets
{
    private $awbs;
    private $smus;

    public function __construct($smus = null, $awbs = null)
    {
        $this->awbs = $awbs;
        $this->smus = $smus;
    }

    public function sheets(): array
    {
        return [
            new Revision($this->smus),
            new RevisionAWB($this->awbs),
        ];
    }
}
