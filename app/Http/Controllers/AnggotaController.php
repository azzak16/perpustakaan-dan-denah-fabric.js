<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use App\User;
use Alert;

class AnggotaController extends Controller
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
    $data_anggota = Anggota::all();
    return view('anggota.index', compact('data_anggota'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $getRow = Anggota::orderBy('id', 'DESC')->get();
    $rowCount = $getRow->count();

    $lastId = $getRow->first();
    $kode = "AG00001";

      if ($rowCount > 0) {
          if ($lastId->id < 9) {
                  $kode = "AG0000".''.($lastId->id + 1);
          } else if ($lastId->id < 99) {
                  $kode = "AG000".''.($lastId->id + 1);
          } else if ($lastId->id < 999) {
                  $kode = "AG00".''.($lastId->id + 1);
          } else if ($lastId->id < 9999) {
                  $kode = "AG0".''.($lastId->id + 1);
          } else {
                  $kode = "AG".''.($lastId->id + 1);
          }
      }
      return view('anggota.create', compact('kode'));
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
      'id_anggota' => 'required',
      'nama' => 'required|max:25',
      'agama' => 'required',
      'tempat_lahir' => 'required',
      'tgl_lahir' => 'required',
      'alamat' => 'required',
      'no_hp' => 'required',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:8|confirmed',


  ]);
    $data_user = new User();
    $data_user->role = 'user';
    $data_user->name = $request->nama;
    $data_user->email = $request->email;
    $data_user->password = bcrypt($request->password);
    $data_user->save();


    $request->request->add(['user_id' => $data_user->id]);
    $data_anggota = Anggota::create($request->all());


    return redirect()->route('anggota.index');
    ;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data_anggota = Anggota::findOrFail($id);

    return view('anggota.show', compact('data_anggota'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data_anggota = Anggota::findOrFail($id);
    return view('anggota.edit', compact('data_anggota'));
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
    $data_anggota = Anggota::findOrFail($id);
    $data_anggota->update($request->all());

    return redirect()->route('anggota.show', ['id'=>$data_anggota]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $data_anggota = Anggota::findOrFail($id);
    $data_anggota->delete();


    return redirect()->route('anggota.index');
  }
}
