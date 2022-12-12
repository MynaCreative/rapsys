<?php

namespace App\Exports\LineType;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\LineType\Sample\Item;

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
