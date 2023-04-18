<?php

namespace App\Exports\CostCenter;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\CostCenter\Sample\Item;

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
