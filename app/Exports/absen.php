<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class absen implements WithMultipleSheets
{
    protected $month;
    public function __construct(int $month)
    {
        $this->month = $month;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new admin($this->month);
        $sheets[] = new engineer($this->month);
        $sheets[] = new Thl($this->month);

        return $sheets;
    }
}
