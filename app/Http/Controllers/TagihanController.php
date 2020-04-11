<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\TipeTagihan;
use App\Tagihan;
use App\TipeKelas;
use App\Siswa;
use App\Petugas;
use App\Kelas;
use App\Pembayaran;

class TagihanController extends Controller
{
    public function showUpdate($id)
    {
        $tagihan = Tagihan::find($id);
        return view('pages.updatetagihan', compact(['tagihan']))->with('status','update');
    }

    public function update(Request $request,$id)
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
            'sudah_dibayar' => 'bail|required|integer',
        ], $messages);

        $tagihan = Tagihan::find($id);
        $nominal = $tagihan->tipetagihan->nominal - $request->sudah_dibayar;
        if($nominal==0)
        {
            $tagihan->keterangan = "lunas";            
        } else {
            $tagihan->keterangan = "blm_lunas";
        }
        $tagihan->sudah_dibayar = $request->sudah_dibayar;
        $tagihan->update();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Siswa Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect('data/tipetagihan/detail/' . $tagihan->tipetagihan->slug . '/' .  $tagihan->tipetagihan->id)->with($notification);
    }

    public function destroy($id)
    {
        $tagihan = Tagihan::find($id);
        $tagihan->delete();

        $siswa = $tagihan->siswa->id;
        $pembayaran = Pembayaran::where('tagihan_id',$id)->where('siswa_id',$siswa)->get()->each->delete();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Tagihan Berhasil Dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
