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

class trsExcel implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): view
    {
      if(request('status'))
        {
            if(request('status') == 'book') {
              return view('laporan.trsExcel',[
                'transaksis'=> Transaksi::where('status', 'book')->get()
              ]);
            }
            elseif(request('status') == 'pinjam') {
              return view('laporan.trsExcel',[
                'transaksis'=> Transaksi::where('status', 'pinjam')->get()
              ]);
            }
            else {
              return view('laporan.trsExcel',[
                'transaksis'=> Transaksi::where('status', 'kembali')->get()
              ]);
            }
        }
      return view('laporan.trsExcel',[
        'transaksis'=> Transaksi::all()
      ]);
    }
}
