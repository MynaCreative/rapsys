<?php

namespace App\Exports\InvoiceType;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\InvoiceType\Sample\Item;

class Sample implements WithMultipleSheets
{
    public function sheets(): array
    {
        $page = basename(dirname(__FILE__));
        return [
            new Item($page),
        ];
    }
}
