<?php

namespace App\Exports;

use App\Buku;
use App\Kategori;
use App\Transaksi;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class excelRak implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): view
    {
      $rakId = request('rak_id');
      return view('laporan.bukuExcel',[
        'bukus'=> Buku::where('rak_id',$rakId)->orderBy('kategori_id', 'asc')->get()
      ]);
    }
}
