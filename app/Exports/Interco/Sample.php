<?php

namespace App\Exports\Interco;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Interco\Sample\Item;

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
