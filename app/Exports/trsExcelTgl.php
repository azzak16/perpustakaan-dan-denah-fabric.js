<?php

namespace App\Exports;

use App\Buku;
use App\Kategori;
use App\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;

class trsExcelTgl implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): view
    {
      $from    = Carbon::parse(request('from'))
                 ->startOfDay()        // 2018-09-29 00:00:00.000000
                 ->toDateTimeString(); // 2018-09-29 00:00:00

      $to      = Carbon::parse(request('to'))
                 ->endOfDay()          // 2018-09-29 23:59:59.000000
                 ->toDateTimeString(); // 2018-09-29 23:59:59

      return view('laporan.trsExcel',[
        'transaksis'=> Transaksi::whereBetween('created_at', [$from, $to])->get()
      ]);
    }
}
