<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
use App\Autentikasi;
use App\Petugas;
use App\Role;
use App\Kelas;
use Image;
use File;
use Auth;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $petugas = Petugas::all()->except(Auth::User()->petugas->id);
        $role = Role::find(['2','3']);
        return view('pages.petugas', compact(['petugas','role']));
    }

    public function detail($slug)
    {
        $petugas = Petugas::where('slug',$slug)->first();
        return view('pages.detailpetugas', compact(['petugas']));
    }

    public function tambah()
    {
        $role = Role::find([2,3]);
        return view('pages.tambahpetugas', compact(['role']))->with('status','tambah');
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
            'nama_petugas' => 'bail|required|string|max:200',
            'profil' => 'bail|required|file|mimes:jpeg,bmp,png,jpg|max:1000',
            'role_id' => 'bail|required|integer',
            'no_telp' => 'bail|required|string|min:10|max:13',
            'nomor_induk' => 'bail|required|string|min:10|max:30',
            'email' => 'bail|required|email|unique:t_autentikasi',
        ], $messages);

        $path = "uploaded/images/profil_petugas/";
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $profil = $request->file('profil');
        $nama_gambar = explode(" ", $request->nama_petugas)[0] . '_Profil_' . Carbon::now()->format('Y_m_d') . '.' . $profil->getClientOriginalExtension(); 
        Image::make(File::get($profil))->resize(350, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path.$nama_gambar);

        $petugas = new Petugas;
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->slug = Str::slug($request->nama_petugas,'-');
        $petugas->profil = $nama_gambar;
        $petugas->role_id = $request->role_id;
        $petugas->no_telp = $request->no_telp;
        $petugas->save();

        $petugas_id = Petugas::orderBy('id','desc')->first()->id;

        $auth = new Autentikasi;
        $auth->nomor_induk = $request->nomor_induk;
        $auth->email = $request->email;
        $auth->password = Hash::make($request->nomor_induk);
        $auth->role_id = $request->role_id;
        $auth->petugas_id = $petugas_id;
        $auth->save();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Petugas Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect('data/petugas')->with($notification);
    }

    public function showupdate(Request $request, $slug, $id)
    {
        $role = Role::find([2,3]);
        $auth = Autentikasi::where('petugas_id', $id)->first();
        $petugas = Petugas::where('slug',$slug)->first();
        return view('pages.tambahpetugas', compact(['petugas','role','auth']))->with('status','update');
    }

    public function update(Request $request, $slug, $id)
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
            'nama_petugas' => 'bail|required|string|max:200',
            'profil' => 'bail|file|mimes:jpeg,bmp,png,jpg|max:1000',
            'role_id' => 'bail|required|integer',
            'no_telp' => 'bail|required|string|min:10|max:13',
            'nomor_induk' => 'bail|required|string|min:10|max:30'
        ], $messages);

        $petugas = Petugas::where('slug',$slug)->first();
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->no_telp = $request->no_telp;
        $petugas->slug = Str::slug($request->nama_petugas,'-');
        $petugas->role_id = $request->role_id;
        $petugas->created_at = Carbon::now()->format('Y-m-d H:i:s');

        if($request->hasfile('profil')){
            $gambar_lama = public_path("uploaded/images/profil_petugas/" . $petugas->profil);
            \File::delete($gambar_lama);

            $profil = $request->file('profil');
            $nama_gambar = explode(" ", $request->nama_petugas)[0] . '_Profil_' . Carbon::now()->format('Y_m_d') . '.' . $profil->getClientOriginalExtension(); 
            Image::make(File::get($profil))->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploaded/images/profil_petugas/" . $nama_gambar);
            $petugas->profil = $nama_gambar;
        }
        $petugas->update();

        $auth = Autentikasi::where('petugas_id',$id)->first();
        $auth->nomor_induk = $request->nomor_induk;
        $auth->email = $request->email;
        $auth->role_id = $request->role_id;
        if(strlen($request->password)>0)
        {
            $auth->password = Hash::make($request->password);
        }
        $auth->update();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Petugas Berhasil Diperbaharui!',
            'alert-type' => 'success'
        );

        return redirect('data/petugas')->with($notification);
    }

    public function destroy($id)
    {
        $petugas = Petugas::find($id);
        $gambar_lama = public_path("uploaded/images/profil_petugas/" . $petugas->profil);
        if(\File::exists($gambar_lama)){
            \File::delete($gambar_lama);
        }
        $petugas->delete();
        $auth = Autentikasi::where('petugas_id', $id)->first()->delete();
        echo json_encode('sukses');
    }
}
