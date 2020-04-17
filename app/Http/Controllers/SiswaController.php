<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
use App\Siswa;
use App\Autentikasi;
use App\Pembayaran;
use App\Tagihan;
use App\Kelas;
use Image;
use File;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        return view('pages.siswa', compact(['siswa','kelas']));
    }

    public function tambah()
    {
        $kelas = Kelas::all();
        return view('pages.tambahsiswa', compact(['kelas']))->with('status','tambah');
    }

    public function detail($slug,$id)
    {
        $auth = Autentikasi::where('siswa_id',$id)->first();
        $tagihan = Tagihan::where('siswa_id', $id)->where('tipetagihan_id','>=','6')->get();
        $tagihan_spp = Tagihan::where('siswa_id', $id)->whereBetween('tipetagihan_id', [1, 5])->get();
        $siswa = Siswa::where('slug',$slug)->first();
        $history = Pembayaran::where('siswa_id',$id)->orderBy('id', 'DESC')->get();
        return view('pages.detailsiswa', compact(['siswa','history','tagihan_spp','tagihan','auth']));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute terlalu pendek, minimal :min karakter',
            'max' => ':attribute terlalu panjang, maksimal :max karakter',
            'email' => ':attribute memerlukan "@"',
            'profil.max' => 'file terlalu besar, maksimal berukuran 1 Mb',
            'size' => ':attribute terlalu besar, maksimal berukuran :size',
            'mimes' => 'format file salah, harus berjenis jpg,jpeg,png,bmp',
            'unique' => ':attribute sudah terpakai'
        ];

        $this->validate($request, [
            'nisn' => 'bail|required|string|max:15',
            'nama_siswa' => 'bail|required|string|max:200',
            'alamat' => 'bail|required|string|max:220',
            'no_telp' => 'bail|required|string|min:10|max:13',
            'kelas_id' => 'bail|required|integer',
            'profil' => 'bail|required|file|mimes:jpeg,bmp,png,jpg|max:1000',
            'nomor_induk' => 'required|string|unique:t_autentikasi|min:10|max:12',
            'email' => 'bail|required|email|unique:t_autentikasi',
        ], $messages);

        $path = "uploaded/images/profil_siswa/";
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $profil = $request->file('profil');
        $nama_gambar = explode(" ", $request->nama_siswa)[0] . '_Profil_' . Carbon::now()->format('Y_m_d') . '.' . $profil->getClientOriginalExtension(); 
        Image::make(File::get($profil))->resize(350, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path.$nama_gambar);

        $tipekelas_id = Kelas::find($request->kelas_id)->tipekelas->id;

        $siswa = new Siswa;
        $siswa->nisn = $request->nisn;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->slug = Str::slug($request->nama_siswa,'-');
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->tipekelas_id = $tipekelas_id;
        $siswa->profil = $nama_gambar;
        $siswa->role_id = 1;
        $siswa->save();

        $siswa_id = Siswa::orderBy('id','desc')->first()->id;

        $auth = new Autentikasi;
        $auth->nomor_induk = $request->nomor_induk;
        $auth->email = $request->email;
        $auth->password = Hash::make($request->nomor_induk);
        $auth->role_id = 1;
        $auth->siswa_id = $siswa_id;
        $auth->save();

        $paket_spp_x = array(3,4,5);
        $paket_spp_xi = array(2,3,4);
        $paket_spp_xii = array(1,2,3);

        $siswa_id = Siswa::orderBy('id','desc')->first()->id;

        $tingkat_kelas = Kelas::find($request->kelas_id);
        if($tingkat_kelas->tipekelas_id==1)
        {
            for($x = 0; $x < count($paket_spp_x); $x++)
            {
                $tagihan = new Tagihan;
                $tagihan->siswa_id = $siswa_id;
                $tagihan->tipetagihan_id = $paket_spp_x[$x];
                $tagihan->sudah_dibayar = 0;
                $tagihan->keterangan = "blm_lunas";
                $tagihan->save();
            }
        } else if ($tingkat_kelas->tipekelas_id==2){
            for($y = 0; $y < count($paket_spp_xi); $y++)
            {
                $tagihan = new Tagihan;
                $tagihan->siswa_id = $siswa_id;
                $tagihan->tipetagihan_id = $paket_spp_xi[$y];
                $tagihan->sudah_dibayar = 0;
                $tagihan->keterangan = "blm_lunas";
                $tagihan->save();
            }
        } else {
            for($z = 0; $z < count($paket_spp_xii); $z++)
            {
                $tagihan = new Tagihan;
                $tagihan->siswa_id = $siswa_id;
                $tagihan->tipetagihan_id = $paket_spp_xii[$z];
                $tagihan->sudah_dibayar = 0;
                $tagihan->keterangan = "blm_lunas";
                $tagihan->save();
            }
        }

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Siswa Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect('data/siswa')->with($notification);
    }

    public function showupdate(Request $request, $slug, $id)
    {
        $auth = Autentikasi::where('siswa_id', $id)->first();
        $siswa = Siswa::where('slug', $slug)->first();
        $kelas = Kelas::all();
        return view('pages.tambahsiswa', compact(['kelas','siswa','auth']))->with('status','update');
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute terlalu pendek, minimal :min karakter',
            'max' => ':attribute terlalu panjang, maksimal :max karakter',
            'email' => ':attribute memerlukan "@"',
            'profil.max' => 'file terlalu besar, maksimal berukuran 1 Mb',
            'size' => ':attribute terlalu besar, maksimal berukuran :size',
            'mimes' => 'format file salah, harus berjenis jpg,jpeg,png,bmp',
            'unique' => ':attribute sudah terpakai'
        ];

        $this->validate($request, [
            'nisn' => 'bail|required|string|max:15',
            'nama_siswa' => 'bail|required|string|max:200',
            'alamat' => 'bail|required|string|max:220',
            'no_telp' => 'bail|required|string|min:10|max:13',
            'kelas_id' => 'bail|required|integer',
            'profil' => 'bail|file|mimes:jpeg,bmp,png,jpg|max:1000',
            'nomor_induk' => 'required|string|min:10|max:12',
        ], $messages);

        $siswa = Siswa::find($id);
        $siswa->nisn = $request->nisn;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->slug = Str::slug($request->nama_siswa,'-');
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        if($request->hasfile('profil')){
            $gambar_lama = public_path("uploaded/images/profil_siswa/" . $siswa->profil);
            \File::delete($gambar_lama);

            $profil = $request->file('profil');
            $nama_gambar = explode(" ", $request->nama_siswa)[0] . '_Profil_' . Carbon::now()->format('Y_m_d') . '.' . $profil->getClientOriginalExtension(); 
            Image::make(File::get($profil))->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploaded/images/profil_siswa/" . $nama_gambar);
            $siswa->profil = $nama_gambar;
        }
        $siswa->update();

        $auth = Autentikasi::where('siswa_id',$id)->first();
        $auth->nomor_induk = $request->nomor_induk;
        $auth->email = $request->email;
        if(strlen($request->password)>0)
        {
            $auth->password = Hash::make($request->password);
        }
        $auth->update();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Siswa Berhasil Diperbaharui!',
            'alert-type' => 'success'
        );

        return redirect('data/siswa')->with($notification);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $gambar_lama = public_path("uploaded/images/profil_siswa/" . $siswa->profil);
        if(\File::exists($gambar_lama)){
            \File::delete($gambar_lama);
        }
        $siswa->delete();
        $auth = Autentikasi::where('siswa_id',$id)->first()->delete();
        $tagihan = Tagihan::where('siswa_id',$id)->get()->each->delete();
        $pembayaran = Pembayaran::where('siswa_id',$id)->get()->each->delete();

        return redirect()->back();
    }
}