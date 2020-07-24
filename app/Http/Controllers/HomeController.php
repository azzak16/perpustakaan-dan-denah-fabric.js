<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Kategori;
use App\Rak;
use App\Anggota;
use App\Pegawai;
use App\Transaksi;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $bukus = Buku::all();
      $kategoris = Kategori::all();
      $raks = Rak::all();
      $anggotas = Anggota::all();
      $pegawais = Pegawai::all();
      $transaksis = Transaksi::all();

  //     $datasets = [];
  //     $bgclr = ['#1abc9c',
  //     '#e056fd',
  //     '#2ecc71',
  //     '#3498db',
  //     '#9b59b6',
  //     '#f1c40f',
  //     '#e67e22',
  //     '#e74c3c',
  //   '#34495e',
  //   '#95a5a6',
  //   '#30336b',
  //   '#ff7979',
  //   '#badc58',
  //   '#ffeaa7',
  //   '#4cd137',
  //   '#c23616',
  //   '#1B1464',
  //   '#833471',
  //   '#D980FA',
  //   '#fff200'
  // ];
  //     $labels = [];
  //     $i = 0;

  //     foreach ($kategoris as $data) {

  //       $transaksisJan = DB::table('transaksis')->whereMonth('created_at',1)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisFeb = DB::table('transaksis')->whereMonth('created_at',2)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisMar = DB::table('transaksis')->whereMonth('created_at',3)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisApr = DB::table('transaksis')->whereMonth('created_at',4)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisMei = DB::table('transaksis')->whereMonth('created_at',5)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisJun = DB::table('transaksis')->whereMonth('created_at',6)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisJul = DB::table('transaksis')->whereMonth('created_at',7)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisAgu = DB::table('transaksis')->whereMonth('created_at',8)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisSep = DB::table('transaksis')->whereMonth('created_at',9)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisOkt = DB::table('transaksis')->whereMonth('created_at',10)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisNov = DB::table('transaksis')->whereMonth('created_at',11)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $transaksisDes = DB::table('transaksis')->whereMonth('created_at',12)
  //       ->where('kategori_id',$data->id)
  //       ->count();
  //       $labels[] = $data->kategori;
  //       $datasets[] =
  //         ['label'=>$data->kategori,
  //         'data'=>[
  //           $transaksisJan, $transaksisFeb,$transaksisMar,$transaksisApr,$transaksisMei,$transaksisJun,$transaksisJul,
  //           $transaksisAgu,$transaksisSep,$transaksisOkt,$transaksisNov,$transaksisDes,
  //       ],
  //         'backgroundColor'=>

  //           //$data->color,
  //           $bgclr[$i],
  //           $i++,
  //         'hoverBorderColor'=>
  //           '#000',

  //         'hoverBorderWidth'=>1];

  //     }
      //dd($datasets);
      // return $datasets;
      // return view('dash.home', compact('bukus','kategoris','raks','anggotas','pegawais','datasets','transaksis','labels'));
      return view('dash.home', compact('bukus','kategoris','raks','anggotas','pegawais','transaksis'));
    }
}
