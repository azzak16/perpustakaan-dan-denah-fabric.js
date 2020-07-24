<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Anggota;
use App\Pegawai;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data_user = User::findOrFail($id);

        return view('user.show', compact('data_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data_user = User::findOrFail($id);

        return view('user.edit', compact('data_user'));
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
      $this->validate($request, [

        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
        // 'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8|confirmed',
        'avatar' => 'mimes:jpeg,png',
      ]);


      $data_user = User::findOrFail($id);

      $dt = Carbon::now();
      $filename = str_random(10).'-'.$dt->format('Y-m-d-H-i-s');


      if(Auth::user()->role == 'ptgs'){
      Pegawai::where('user_id',$id)->update(['jenis_kelamin' => $request->jenis_kelamin]);
      Pegawai::where('user_id',$id)->update(['alamat' => $request->alamat]);
      Pegawai::where('user_id',$id)->update(['no_hp' => $request->no_hp]);
      if($request->hasFile('avatar')){
        $request->file('avatar')->move('images/', $filename.'.'.$request->file('avatar')->getClientOriginalExtension());
        Pegawai::where('user_id',$id)->update(['avatar' => $filename.'.'.$request->file('avatar')->getClientOriginalExtension()]);
      }
    }

      elseif(Auth::user()->role == 'user'){
      Anggota::where('user_id',$id)->update(['jenis_kelamin' => $request->jenis_kelamin]);
      Anggota::where('user_id',$id)->update(['alamat' => $request->alamat]);
      Anggota::where('user_id',$id)->update(['no_hp' => $request->no_hp]);
      if($request->hasFile('avatar')){
        $request->file('avatar')->move('images/', $filename.'.'.$request->file('avatar')->getClientOriginalExtension());
        Anggota::where('user_id',$id)->update(['avatar' => $filename.'.'.$request->file('avatar')->getClientOriginalExtension()]);
      }
    }

      // $data_user->email = $request->email;
      $data_user->password = bcrypt($request->password);

      $data_user->update();

      // dd($request->all());
      return redirect()->route('user.edit', compact('data_user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
