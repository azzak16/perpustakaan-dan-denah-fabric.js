<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\user;

class PegawaiController extends Controller
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
      $data_pegawai = Pegawai::all();
      return view('pegawai.index', compact('data_pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $getRow = pegawai::orderBy('id', 'DESC')->get();
      $rowCount = $getRow->count();

      $lastId = $getRow->first();
      $kode = "PG00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "PG0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "PG000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "PG00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "PG0".''.($lastId->id + 1);
            } else {
                    $kode = "PG".''.($lastId->id + 1);
            }
        }

    // $data_peg = pegawai::max('id_pegawai');
    // $no_urut = (int) substr($data_peg, 3, 3);
    // $no_urut++;
    // $char = "PG";
    // $kodep = $char . sprintf("%03s",$no_urut);

    // dd($kodep);

    return view('pegawai.create', compact('kode'));
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
    $data_user->role = 'ptgs';
    $data_user->name = $request->nama;
    $data_user->email = $request->email;
    $data_user->password = bcrypt($request->password);
    $data_user->save();


    $request->request->add(['user_id' => $data_user->id]);
    $data_pegawai = Pegawai::create($request->all());

    return redirect()->route('pegawai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data_pegawai = Pegawai::findOrFail($id);

      return view('pegawai.show', compact('data_pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data_pegawai = Pegawai::findOrFail($id);
      return view('pegawai.edit', compact('data_pegawai'));
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
      $data_pegawai = pegawai::findOrFail($id);
      $data_pegawai->update($request->all());

      return redirect()->route('pegawai.show', ['id'=>$data_pegawai]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data_pegawai = Pegawai::findOrFail($id);
      $data_pegawai->delete();
      return redirect()->route('pegawai.index');
    }
}
