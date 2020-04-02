<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
use App\Petugas;
use App\Role;
use Image;
use File;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $petugas = Petugas::paginate(10);
        return view('pages.petugas', compact(['petugas']));
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
        // $messages = [
        //     'required' => ':attribute wajib diisi',
        //     'min' => ':attribute harus diisi minimal :min karakter',
        //     'max' => ':attribute harus diisi maksimal :max karakter',
        //     'email' => ':attribute memerlukan "@"'
        // ];

        // $this->validate($request, [
        //     'nip' => 'bail|required|integer',
        //     'nama_petugas' => 'bail|required|integer',
        //     'email' => 'bail|required|string|max:255',
        //     'password' => 'bail|required|string',
        //     'profil' => 'bail|required|string',
        //     'level' => 'bail|required|string',
        // ], $messages);

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
        $petugas->nip = $request->nip;
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->email = $request->email;
        $petugas->password = Hash::make($request->password);
        $petugas->slug = Str::slug($request->nama_petugas,'-');
        $petugas->profil = $nama_gambar;
        $petugas->role_id = $request->role;
        $petugas->no_telp = $request->no_telp;
        $petugas->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $petugas->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $petugas->save();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Petugas Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect('data/petugas')->with($notification);
    }

    public function showupdate(Request $request, $slug)
    {
        $role = Role::find([2,3]);
        $petugas = Petugas::where('slug',$slug)->first();
        return view('pages.tambahpetugas', compact(['petugas','role']))->with('status','update');
    }

    public function update(Request $request, $slug)
    {
        $petugas = Petugas::where('slug',$slug)->first();
        $petugas->nip = $request->nip;
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->email = $request->email;

        if(strlen($request->password)>0)
        {
            $petugas->password = Hash::make($request->password);
        }

        $petugas->no_telp = $request->no_telp;
        $petugas->slug = Str::slug($request->nama_petugas,'-');
        $petugas->role_id = $request->role;
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
        
        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Petugas Berhasil Dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
