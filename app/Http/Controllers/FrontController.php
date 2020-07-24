<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Anggota;
use App\Buku;
use App\Kategori;
use App\Transaksi;
use App\Denah;
use App\User;
use App\Post;

class FrontController extends Controller
{
    public function home()
    {
      $post = Post::orderBy('created_at', 'DESC')->paginate(4);
      $buku = Buku::orderBy('created_at', 'DESC')->take(9)->get();
      return view('front.welcome', compact('post', 'buku'));
    }

    public function about()
    {
      return view('front.about');
    }

    public function kateg($id)
    {
      $bukus = Buku::where('kategori_id',$id)
      ->paginate(8);
      $kategoris = Kategori::all();
      $denahs = Denah::all()->where('status', 'aktif');
    return view('front.katalog', compact('bukus','kategoris','denahs'));

    }

    // public function load(Request $request)
    // {
    //   $file= $request->file;
    //   $denahs = DB::table('denahs')->where('id', 15)->first();
    //   return response($denahs->file);
    //   }

    public function katalog(request $request)
    {
      if($request->has('cari')){
        $bukus = Buku::where('judul_buku','LIKE','%'.$request->cari.'%')
        ->paginate(8);
      }else{
        $bukus = Buku::paginate(8);
      }
      $kategoris = Kategori::all();
      $denahs = Denah::all()->where('status', 'aktif');

    return view('front.katalog', compact('bukus','kategoris', 'denahs'));
    }

    public function katalogdet($id)
    {
      $bukus = Buku::findOrFail($id);
      $kategoris = Kategori::all();
      return view('front.katalogdet', compact('bukus','kategoris'));
    }

    public function reg()
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
      return view('front.reg', compact('kode'));
    }

    public function postreg(Request $request)
    {
// dd($Request->all());
    $data_user = new User();
    $data_user->role = 'user';
    $data_user->name = $request->nama;
    $data_user->email = $request->email;
    $data_user->password = bcrypt($request->password);
    $data_user->save();

    $request->request->add(['user_id' => $data_user->id]);
    $data_anggota = Anggota::create($request->all());

    return redirect('/');
    }

    public function singlepost($slug)
    {
      $post = Post::where('slug', $slug)->first();

      $data_user = User::all();
      return view('front.singlepost', compact('post', 'data_user'));
    }
}
