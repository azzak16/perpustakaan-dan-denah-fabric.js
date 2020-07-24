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

class ExcelKategori implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): view
    {
      $kategId = request('kateg_id');
      return view('laporan.bukuExcel',[
        'bukus'=> Buku::where('kateg_id',$kategId)->orderBy('rak_id', 'asc')->get()
      ]);
    }
}
