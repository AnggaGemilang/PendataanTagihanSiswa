<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
use App\Kelas;
use Image;
use File;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelas = Kelas::paginate(10);
        return view('pages.kelas', compact(['kelas']));
    }

    public function detail($slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        return view('pages.detailkelas', compact(['kelas','history']));
    }

    public function tambah()
    {
        return view('pages.tambahkelas')->with('status','tambah');
    }

    public function store(Request $request)
    {
        $kelas = new Kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->slug = Str::slug($request->nama_kelas,'-');
        $kelas->jurusan = $request->jurusan;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $kelas->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $kelas->save();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Kelas Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect('data/kelas')->with($notification);
    }

    public function showupdate(Request $request, $slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        return view('pages.tambahkelas', compact(['kelas']))->with('status','update');
    }

    public function update(Request $request, $slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->slug = Str::slug($request->nama_kelas,'-');
        $kelas->jurusan = $request->jurusan;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $kelas->update();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Kelas Berhasil Diperbaharui!',
            'alert-type' => 'success'
        );

        return redirect('data/kelas')->with($notification);
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        
        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Kelas Berhasil Dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
