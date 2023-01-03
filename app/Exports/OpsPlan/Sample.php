<?php

namespace App\Exports\OpsPlan;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\OpsPlan\Sample\Item;

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
