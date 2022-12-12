<?php

namespace App\Exports\Product;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Product\Sample\Item;

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
