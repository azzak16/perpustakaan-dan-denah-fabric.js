<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\Buku;
use App\Anggota;
use App\Pegawai;
use App\User;
use App\Denda;
use Auth;
use Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      if(Auth::user()->role == 'user')
        {
            $data_transaksi = Transaksi::where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $data_transaksi = Transaksi::all();
            // ->whereIn('status', ['pinjam','kembali']);
        }
      return view('transaksi.index', compact('data_transaksi'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $getRow = Transaksi::orderBy('id', 'DESC')->get();
      $rowCount = $getRow->count();

      $lastId = $getRow->first();

      $kode = "TR00001";

      if ($rowCount > 0) {
          if ($lastId->id < 9) {
                  $kode = "TR0000".''.($lastId->id + 1);
          } else if ($lastId->id < 99) {
                  $kode = "TR000".''.($lastId->id + 1);
          } else if ($lastId->id < 999) {
                  $kode = "TR00".''.($lastId->id + 1);
          } else if ($lastId->id < 9999) {
                  $kode = "TR0".''.($lastId->id + 1);
          } else {
                  $kode = "TR".''.($lastId->id + 1);
          }
      }
$tes3 = 0;

      if(Auth::user()->role == 'user')
      {
       $tes = Auth::user()->anggota->id;
       $tes2 = Transaksi::all()
                        ->whereIn('status', ['pinjam','book'])
                        ->where('anggota_id', '=', $tes);
        $tes3 = count($tes2);
      }
        $data_buku = Buku::where('jumlah', '>', 0)->get();
        $data_pegawai = Pegawai::all();
        $data_anggota = Anggota::whereDoesntHave('Transaksi', function($q){
                            $q->whereIn('status', ['book','pinjam']);
        })->get();
// return $tes3;
        return view('transaksi.create', compact('data_buku', 'data_pegawai', 'data_anggota', 'kode', 'tes3'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
      if(Auth::user()->role == 'user')
        {
          $this->validate($request, [
          'kode_transaksi' => 'required',
          'tgl_book' => 'required',
          'jam_book' => ['required','after:08:00','before:16:00'],
          'buku_id' => 'required',
          'anggota_id' => 'required',
          ]);
        }
      else{
      $this->validate($request, [
        'kode_transaksi' => 'required',
        'tgl_pinjam' => 'required',
        'tgl_kembali' => 'required',
        'buku_id' => 'required',
        'anggota_id' => 'required',
        'pegawai_id' => 'required',
    ]);
      }

      $data_transaksi = Transaksi::create([
        'kode_transaksi' => $request->get('kode_transaksi'),
        'tgl_pinjam' => $request->get('tgl_pinjam'),
        'tgl_kembali' => $request->get('tgl_kembali'),
        'tgl_book' => $request->get('tgl_book'),
        'jam_book' => $request->get('jam_book'),
        'buku_id' => $request->get('buku_id'),
        'kategori_id' => $request->get('kategori_id'),
        'anggota_id' => $request->get('anggota_id'),
        'pegawai_id' => $request->get('pegawai_id'),
        'status' => $request->get('status'),
        'denda_id' => $request->get('denda_id'),

        ]);



    $data_transaksi->buku->where('id', $data_transaksi->buku_id)
                        ->update([
                            'jumlah' => ($data_transaksi->buku->jumlah - 1),
                            ]);
//                           print_r($data_transaksi);
// return $data_transaksi;
        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data_transaksi = Transaksi::findOrFail($id);

        return view('transaksi.show', compact('data_transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data_pegawai = Pegawai::all();
      $data_transaksi = Transaksi::findOrFail($id);
      $data_denda = Denda::all();

      $kembali = $data_transaksi['tgl_kembali'];
      $dikembalikan = Carbon\Carbon::today()->toDateString();
      $formatted_dt1=Carbon\Carbon::parse($kembali);
      $formatted_dt2=Carbon\Carbon::parse($dikembalikan);
      $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
      $tes = $data_transaksi->Denda->denda;


      if ($date_diff > 7) {
        $denda= $date_diff * $tes;
      }else{
        $denda= $date_diff * 0;
      }

      return view('transaksi.edit', compact('data_transaksi', 'denda', 'data_denda', 'data_pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $data_transaksi = Transaksi::find($id);

      $data_transaksi->update($request->all());

        if ($data_transaksi->status == 'kembali') {
          $data_transaksi->buku->where('id', $data_transaksi->buku->id)
                        ->update([
                            'jumlah' => ($data_transaksi->buku->jumlah + 1),
                            ]);}
        elseif ($data_transaksi->status == 'batal') {
          $data_transaksi->buku->where('id', $data_transaksi->buku->id)
                                ->update([
                                  'jumlah' => ($data_transaksi->buku->jumlah + 1),
                                  ]);}

      // dd($data_transaksi->buku);
      return redirect()->route('transaksi.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data_transaksi = Transaksi::find($id);

      $data_transaksi->buku->where('id', $data_transaksi->buku->id)
      ->update([
          'jumlah' => ($data_transaksi->buku->jumlah + 1),
          ]);

      $data_transaksi->delete();

      return redirect()->route('transaksi.index');
    }

    public function book()
    {
      $data_transaksi = Transaksi::all()->where('status', 'book');
      // $data_transaksiwhere($data_transaksi->status == 'book');
// dd($data_transaksi);
      return view('transaksi.book', compact('data_transaksi'));

    }

    public function pinjam()
    {
      $data_transaksi = Transaksi::all()->where('status', 'pinjam');
      return view('transaksi.pinjam', compact('data_transaksi'));

    }

    public function kembali()
    {
      $data_transaksi = Transaksi::all()->where('status', 'kembali');
      return view('transaksi.kembali', compact('data_transaksi'));

    }

    public function batal()
    {
      $data_transaksi = Transaksi::all()->where('status', 'batal');
      return view('transaksi.batal', compact('data_transaksi'));

    }
}
