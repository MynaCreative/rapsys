<?php

namespace App\Exports\Currency;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Currency\Sample\Item;

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
