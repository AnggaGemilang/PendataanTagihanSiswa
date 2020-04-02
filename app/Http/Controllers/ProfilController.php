<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
use Image;
use File;
use App\Kelas;
use App\Role;
use App\Siswa;
use App\Petugas;

class ProfilController extends Controller
{
    public function index($slug)
    {
        $kelas = Kelas::all();
        $siswa = Siswa::where('slug',$slug)->first();
        $role = Role::all();
        $petugas = Petugas::where('slug',$slug)->first();
        return view('pages.profil', compact(['kelas','siswa','petugas', 'role']));
    }

    public function update(Request $request, $slug)
    {
        $siswa = Siswa::where('slug',$slug)->first();
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->slug = Str::slug($request->nama_siswa,'-');
        $siswa->no_telp = $request->no_telp;
        $siswa->alamat = $request->alamat;
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

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Profil Berhasil Diubah!',
            'alert-type' => 'success'
        );

        return redirect('profil/' . $siswa->slug)->with($notification);
    }

    public function ubahpassword()
    {
        return view('pages.ubahpassword');
    }
}
