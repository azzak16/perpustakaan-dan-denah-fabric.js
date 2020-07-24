<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use App\Exports\ExcelKategori;
use App\Exports\ExcelRak;
use App\Exports\trsExcel;
use App\Exports\trsExcelTgl;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Buku;
use App\Rak;
use App\Kategori;
use App\Transaksi;
use Auth;
use DB;
use PDF;


class LaporanController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $kategoris = Kategori::all();
      $raks =  Rak::all();
      return view('laporan.index', compact('kategoris', 'raks'));
    }

    public function exportExcel()
    {

      $nama = 'laporan_buku_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new LaporanExport, $nama);

    }

    public function exportExcelKateg()
    {

        $nama = 'laporan_buku_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new ExcelKategori, $nama);
    }

    public function exportExcelRak()
    {
      $nama = 'laporan_buku_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new ExcelRak, $nama);
    }

    public function trsExcel(Request $request)
    {

      $nama = 'laporan_transaksi_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new trsExcel, $nama);

    }

    public function trsExcelTgl(Request $request)
    {

      // $from    = Carbon::parse($request->from)
      //            ->startOfDay()        // 2018-09-29 00:00:00.000000
      //            ->toDateTimeString(); // 2018-09-29 00:00:00

      // $to      = Carbon::parse($request->to)
      //            ->endOfDay()          // 2018-09-29 23:59:59.000000
      //            ->toDateTimeString(); // 2018-09-29 23:59:59

      // $transaksis  = Transaksi::query()->whereBetween('created_at', [$from, $to])->get();

      // return view('laporan.transaksiPdf', compact('transaksis'));
      $nama = 'laporan_transaksi_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new trsExcelTgl, $nama);
    }

    public function exportPdf()
    {
      $bukus = Buku::all();

      $pdf = PDF::loadView('laporan.bukuPdf', compact('bukus'));
      return $pdf->download('buku.pdf');
    }

    public function exportPdfKateg($id)
    {
      $q = Buku::query();

        $q->where('kategori_id',$id);

        $bukus = $q->orderBy('rak_id', 'asc')->get();

        $pdf = PDF::loadView('laporan.bukuPdf', compact('bukus'));
        return $pdf->download('buku.pdf');
    }

    public function exportPdfRak($id)
    {
      $q = Buku::query();

        $q->where('rak_id',$id);

        $bukus = $q->orderBy('kategori_id', 'asc')->get();

        $pdf = PDF::loadView('laporan.bukuPdf', compact('bukus'));
        return $pdf->download('buku.pdf');
    }

    public function trsPdf(Request $request)
    {
      $trs = Transaksi::query();

      if($request->get('status'))
        {
            if($request->get('status') == 'book') {
                $trs->where('status', 'book');
            }
            elseif($request->get('status') == 'pinjam') {
                $trs->where('status', 'pinjam');
            }
            else {
              $trs->where('status', 'kembali');
            }
        }

        $transaksis = $trs->get();

      $pdf = PDF::loadView('laporan.transaksiPdf', compact('transaksis'))->setPaper('a4', 'landscape');
      return $pdf->download('transaksi.pdf');
    }

    public function trsPdfTgl(Request $request)
    {

      $from    = Carbon::parse($request->from)
                 ->startOfDay()        // 2018-09-29 00:00:00.000000
                 ->toDateTimeString(); // 2018-09-29 00:00:00

      $to      = Carbon::parse($request->to)
                 ->endOfDay()          // 2018-09-29 23:59:59.000000
                 ->toDateTimeString(); // 2018-09-29 23:59:59

      $transaksis  = Transaksi::query()->whereBetween('created_at', [$from, $to])->get();

      // return view('laporan.transaksiPdf', compact('transaksis'));
      $pdf = PDF::loadView('laporan.transaksiPdf', compact('transaksis'))->setPaper('a4', 'landscape');
      return $pdf->download('transaksi.pdf');
    }
}
