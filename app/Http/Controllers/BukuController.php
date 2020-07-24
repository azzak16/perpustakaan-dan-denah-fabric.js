<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Kategori;
use App\Rak;
use Carbon\Carbon;

class BukuController extends Controller
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
    $data_buku = Buku::all();
    return view('buku.index', compact('data_buku'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data_kate =  Kategori::all();
    $data_rak =  Rak::all();


    return view('buku.create', compact('data_kate','data_rak'));

    // $data_kate = Kategori::all();
    //   return view('buku.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
    'kode_buku' => 'required|unique:bukus',
    'judul_buku' => 'required',
    'penulis' => 'required',
    'penerbit' => 'required',
    'tahun_terbit' => 'required',
    'deskripsi' => 'required',
    'jumlah' => 'required',
    'cover' => 'mimes:jpeg,png',

    ]);

    // dd($request->all());
    if($request->file('cover')) {
      $file = $request->file('cover');
      $dt = Carbon::now();
      $ext  = $file->getClientOriginalExtension();
      $fileName = str_random(10).'-'.$dt->format('Y-m-d-H-i-s').'.'.$ext;
      $request->file('cover')->move("images/cover", $fileName);
      $cover = $fileName;
  } else {
      $cover = NULL;
  }

  $data = Buku::create([
    'kode_buku' => $request->get('kode_buku'),
    'judul_buku' => $request->get('judul_buku'),
    'penulis' => $request->get('penulis'),
    'penerbit' => $request->get('penerbit'),
    'tahun_terbit' => $request->get('tahun_terbit'),
    'deskripsi' => $request->get('deskripsi'),
    'jumlah' => $request->get('jumlah'),
    'kategori_id' => $request->get('kategori'),
    'rak_id' => $request->get('rak'),
    'cover' => $cover
]);





    return redirect()->route('buku.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data_buku = Buku::findOrFail($id);

    return view('buku.show', compact('data_buku'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data_buku = Buku::findOrFail($id);
    $kategori = Kategori::pluck('kategori', 'id');
    $rak = Rak::pluck('rak', 'id');
    $selectedID = $data_buku->kategori_id;
    $selectedID2 = $data_buku->rak_id;

    return view('buku.edit', compact('data_buku', 'kategori', 'id', 'rak', 'selectedID2', 'selectedID'));
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


    if($request->file('cover')) {
      $file = $request->file('cover');
      $dt = Carbon::now();
      $ext  = $file->getClientOriginalExtension();
      $fileName = str_random(10).'-'.$dt->format('Y-m-d-H-i-s').'.'.$ext;
      $request->file('cover')->move("images/cover", $fileName);
      $cover = $fileName;
    } else {
      $cover = NULL;
    }

    Buku::findOrFail($id)->update([
      'kode_buku' => $request->get('kode_buku'),
      'judul_buku' => $request->get('judul_buku'),
      'penulis' => $request->get('penulis'),
      'penerbit' => $request->get('penerbit'),
      'tahun_terbit' => $request->get('tahun_terbit'),
      'deskripsi' => $request->get('deskripsi'),
      'jumlah' => $request->get('jumlah'),
      'kategori_id' => $request->get('kategori'),
      'rak_id' => $request->get('rak'),
      'cover' => $cover
          ]);

    return redirect()->route('buku.show', ['id'=>$id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $data_buku = Buku::findOrFail($id);
    $data_buku->delete();
    return redirect()->route('buku.index');
  }
}
