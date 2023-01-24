<?php

namespace App\Exports\Invoice;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Invoice\Sample\Item;

class Sample implements WithMultipleSheets
{
    private $expense;

    public function __construct($expense = null)
    {
        $this->expense = $expense;
    }

    public function sheets(): array
    {
        $page = basename(dirname(__FILE__));
        return [
            new Item($page, $this->expense),
        ];
    }
}
