<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Denah;
use Illuminate\Support\Facades\DB;

class DenahController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index()
    {
      $denahs = Denah::all();

      return view('denah.denah', compact('denahs'));
    }

    public function store(Request $request)
    {

      Denah::create($request->all());

      return redirect('/denah')->with('success', 'data berhasil dibuat');
    }

    public function load(Request $request)
    {

      $file= $request->file;

      $denahs = DB::table('denahs')->where('id', $file)->first();

      return Response([
        'file' => $denahs->file,
        'status' => $denahs->status]
      );


      // return response($denahs->file);
      }

    public function edit(Request $request)
    {

      $id = $request->data;

      $name = $request->name;
      $status = $request->status;
      $json = $request->json;

      Denah::findOrFail($id)->update([
        'name' => $name,
        'status' => $status,
        'file' => $json,
            ]);

            exit;

      // return redirect()->route('rak.index');

      }

    public function destroy($id)
    {
    $denahs = Denah::find($id);

    $denahs->delete();

    exit;
    }
}
