<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;

class Thl implements FromArray
{

    protected $month;
    public function __construct(int $month)
    {
        $this->month = $month;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $Users = DB::table('Thl')
                ->whereMonth('Tanggal', $this->month)
                ->get();

        $dataUsers = array();
        $no = 1;
        for ($i=0; $i < count($Users); $i++) {
            $dataUsers[$i]['no'] = $no++;
            $dataUsers[$i]['hari'] = $Users[$i]->hari;
            $dataUsers[$i]['tanggal'] = $Users[$i]->tanggal;
            $dataUsers[$i]['nik'] = $Users[$i]->nik;
            $dataUsers[$i]['jam masuk'] = $Users[$i]->jam_masuk;
            $dataUsers[$i]['jam keluar'] = $Users[$i]->jam_keluar;


        }
        return $dataUsers;
    }
    public function withheadings(): array
    {
        return [
            'NO',
            'HARI',
            'TANGGAL',
            'NIK',
            'JAM MASUK',
            'JAM KELUAR'
        ];
    }

    public function title(): string
    {
        return 'Thl';
    }

}
