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

class LaporanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Buku::all();
    // }

    // public function map($bukus): array
    // {
    //   $i=1;
    //     return [
    //       $i,
    //       $bukus->kode_buku,
    //       $bukus->judul_buku,
    //       $bukus->kategori->kategori,
    //       $bukus->jumlah,
    //       $bukus->penerbit,
    //       $bukus->penulis,
    //       $bukus->tahun_terbit,
    //       $bukus->rak->rak,
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         'NO.',
    //         'KODE BUKU',
    //         'JUDUL BUKU',
    //         'KATEGORI',
    //         'JUMLAH',
    //         'PENERBIT',
    //         'PENULIS',
    //         'TAHUN TERBIT',
    //         'LOKASI',
    //     ];
    // }
    public function view(): view
    {
      return view('laporan.bukuExcel',[
        'bukus'=> Buku::all()
      ]);
    }
}
