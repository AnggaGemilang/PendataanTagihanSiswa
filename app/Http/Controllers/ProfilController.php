<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
use Image;
use File;
use App\Kelas;
use App\Role;
use App\Siswa;
use App\Petugas;
use App\Autentikasi;
use Illuminate\Support\Facades\Auth;
use DB;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notification()
    {
        $content = '';
        if(count(Auth::User()->unreadNotifications)==0)
        {
            $content .= '<a href="" id="not">';
            $content .= '<li class="text-center">Tidak Ada Notifikasi</li>';
            $content .= '</a>';
        } else {
            foreach(Auth::User()->unreadNotifications as $notification)
            {
                $content .= '<a href="" data-id="{{ $notification->id }}">';
                $content .= '<li><i class="fas fa-credit-card" style="width:28px; padding-left: 3px;"></i> Anda Membayar'; 
                $content .= '<span style="font-weight: 600;">' . $notification->data['nama_tagihan'] . '</span>';
                $content .= '</li>';
                $content .= '</a>';
            }
        }
        $content .= '</ul>';
        $content .= '</div>';

        $jumlah = count(Auth::User()->unreadNotifications);

        $response = array(
            'jumlah' => $jumlah, 
            'content' => $content,
        );

        echo json_encode($response);
    }

    public function read($id)
    {
        $content = '';
        $notification = Auth::User()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }
        if(count(Auth::User()->unreadNotifications)==0)
        {
            $content .= '<a href="" id="not">';
            $content .= '<li class="text-center">Tidak Ada Notifikasi</li>';
            $content .= '</a>';
        } else {
            foreach(Auth::User()->unreadNotifications as $notification)
            {
                $content .= '<a href="" data-id="{{ $notification->id }}">';
                $content .= '<li><i class="fas fa-credit-card" style="width:28px; padding-left: 3px;"></i> Anda Membayar'; 
                $content .= '<span style="font-weight: 600;">' . $notification->data['nama_tagihan'] . '</span>';
                $content .= '</li>';
                $content .= '</a>';
            }
        }
        $content .= '</ul>';
        $content .= '</div>';

        $jumlah = count(Auth::User()->unreadNotifications);

        $response = array(
            'jumlah' => $jumlah, 
            'content' => $content,
        );

        echo json_encode($response);
    }

    public function index($slug, $id, $role_id)
    {
        if($role_id=="1")
        {
            $auth = Autentikasi::where('siswa_id',$id)->first();
        }else
        {
            $auth = Autentikasi::where('petugas_id',$id)->first();
        }
        $kelas = Kelas::all();
        $role = Role::all();
        return view('pages.profil', compact(['kelas','role', 'auth']));
    }

    public function update(Request $request, $slug, $role_id, $id)
    {
        if($role_id=="1")
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
                'nama_siswa' => 'bail|required|string|max:200',
                'alamat' => 'bail|required|string|max:220',
                'no_telp' => 'bail|required|string|min:10|max:13',
                'profil' => 'file|mimes:jpeg,bmp,png,jpg|max:1000',
            ], $messages);

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
    
            $auth = Autentikasi::where('siswa_id', $id)->first();
            $auth->nomor_induk = $auth->nomor_induk;
            $auth->email = $auth->email;
            $auth->update();

            $notification = array(
                'title' => 'Berhasil',
                'description' => 'Profil Berhasil Diubah!',
                'alert-type' => 'success'
            );
    
            return redirect('profil/' . $auth->siswa->slug . '/' . $auth->siswa->id . '/' . $auth->siswa->role_id)->with($notification);            

        }else{

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
                'no_telp' => 'bail|required|string|min:10|max:13',
                'profil' => 'file|mimes:jpeg,bmp,png,jpg|max:1000',
            ], $messages);

            $petugas = Petugas::where('slug',$slug)->first();
            $petugas->nama_petugas = $request->nama_petugas;
            $petugas->slug = Str::slug($request->nama_petugas,'-');
            $petugas->no_telp = $request->no_telp;
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
            $auth = Autentikasi::where('petugas_id', $id)->first();
            $auth->nomor_induk = $auth->nomor_induk;
            $auth->email = $auth->email;
            $auth->update();

            $notification = array(
                'title' => 'Berhasil',
                'description' => 'Profil Berhasil Diubah!',
                'alert-type' => 'success'
            );
    
            return redirect('profil/' . $auth->petugas->slug . '/' . $auth->petugas->id . '/' . $auth->petugas->role_id )->with($notification);            
        }
    }

    public function ubahpassword()
    {
        return view('pages.ubahpassword');
    }

    public function fetch_oldpassword($old)
    {
        $status = '';
        if (Hash::check($old, Auth::user()->password)) {
            $status = "benar";
        }else{
            $status = "salah";
        }
        return $status;
    }

    public function ubahpasswordstore(Request $request)
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
            'password_baru' => 'bail|required|string|min:6|max:100',
        ], $messages);

        $password = $request->password_baru;
        $id = Auth::User()->id;
        $user = Autentikasi::find($id);
        $user->password = \Hash::make($password);
        $user->update();
        Auth::login($user);

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Password Berhasil Diubah!',
            'alert-type' => 'success'
        );
        return redirect('ubahpassword')->with($notification);
    }
}