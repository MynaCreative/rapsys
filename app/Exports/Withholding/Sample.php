<?php

namespace App\Exports\Withholding;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Withholding\Sample\Item;
use App\Exports\Withholding\Sample\Type;

class Sample implements WithMultipleSheets
{
    public function sheets(): array
    {
        $page = basename(dirname(__FILE__));
        return [
            new Item($page),
            // new Type($page),
        ];
    }
}
