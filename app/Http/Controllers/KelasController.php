<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Kelas;
use App\Siswa;
use App\TipeKelas;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.kelas', compact(['kelas']));
    }

    public function detail($slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        return view('pages.detailkelas', compact(['kelas','history']));
    }

    public function tambah()
    {
        $tipekelas = TipeKelas::all();
        return view('pages.tambahkelas', compact(['tipekelas']))->with('status','tambah');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute terlalu pendek, minimal :min karakter',
            'max' => ':attribute terlalu panjang, maksimal :max karakter',
            'email' => ':attribute memerlukan "@"',
            'size' => ':attribute terlalu besar, maksimal berukuran :size',
            'mimes' => 'format file salah, harus berjenis jpg,jpeg,png,bmp',
            'unique' => ':attribute sudah terpakai'
        ];

        $this->validate($request, [
            'nama_kelas' => 'required|string|max:200',
            'tipekelas_id' => 'required|integer',
            'jurusan' => 'required|string|max:200',
            'wali_kelas' => 'required|string|max:200',
        ], $messages);

        $kelas = new Kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->slug = Str::slug($request->nama_kelas,'-');
        $kelas->jurusan = $request->jurusan;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->tipekelas_id = $request->tipekelas_id;
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
        $kelas = Kelas::where('slug', $slug)->first();
        $tipekelas = TipeKelas::all();
        return view('pages.tambahkelas', compact(['kelas','tipekelas']))->with('status','update');
    }

    public function update(Request $request, $slug)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute terlalu pendek, minimal :min karakter',
            'max' => ':attribute terlalu panjang, maksimal :max karakter',
            'email' => ':attribute memerlukan "@"',
            'size' => ':attribute terlalu besar, maksimal berukuran :size',
            'mimes' => 'format file salah, harus berjenis jpg,jpeg,png,bmp',
            'unique' => ':attribute sudah terpakai'
        ];

        $this->validate($request, [
            'nama_kelas' => 'required|string|max:200',
            'tipekelas_id' => 'required|integer',
            'jurusan' => 'required|string|max:200',
            'wali_kelas' => 'required|string|max:200',
        ], $messages);

        $kelas = Kelas::where('slug',$slug)->first();
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->slug = Str::slug($request->nama_kelas,'-');
        $kelas->jurusan = $request->jurusan;
        $kelas->tipekelas_id = $request->tipekelas_id;
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
        $kelas = Kelas::find($id)->delete();
        $siswa = Siswa::where('kelas_id',$id)->get()->each->delete();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Tagihan Berhasil Dihapus!',
            'alert-type' => 'success'
        );

        echo json_encode('sukses');
    }
}
