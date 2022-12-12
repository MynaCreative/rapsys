<?php

namespace App\Exports\Area;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Area\Sample\Item;

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
