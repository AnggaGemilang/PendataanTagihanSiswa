<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\TipeTagihan;
use App\TipeKelas;
use App\Tagihan;
use App\Siswa;
use App\Petugas;
use App\Kelas;

class TipeTagihanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tipetagihan = TipeTagihan::all();
        return view('pages.tipetagihan', compact(['tipetagihan']));
    }

    public function showUpdate($slug)
    {
        $tipetagihan = TipeTagihan::where('slug',$slug)->first();
        $tipekelas = TipeKelas::all();
        return view('pages.tambahtipetagihan',compact(['tipetagihan','tipekelas']))->with('status','update');
    }

    public function tambah()
    {
        $tipekelas = TipeKelas::all();
        $last_id = TipeTagihan::orderBy('id','DESC')->first();
        return view('pages.tambahtipetagihan', compact(['tipekelas','last_id']))->with('status','tambah');
    }

    public function detail($slug, $id)
    {
        $kelas = Kelas::all();
        $tagihan = Tagihan::where('tipetagihan_id',$id)->get();
        $tipetagihan = TipeTagihan::find($id);
        return view('pages.detailtipetagihan', compact(['tagihan','kelas','tipetagihan']));
    }

    public function store(Request $request, $kelas_id, $tipetagihan_id)
    {
        $tipetagihan = new TipeTagihan;
        $tipetagihan->nama_tagihan = $request->nama_tagihan;
        $tipetagihan->slug = Str::slug($request->nama_tagihan);
        $tipetagihan->nominal = $request->nominal;
        $tipetagihan->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $tipetagihan->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $tipetagihan->save();

        $kelasid_arr = explode(",", $kelas_id);
        $jumlah_siswa_arr = array();

        for($i=0; $i<count($kelasid_arr); $i++)
        {
            echo "Limit : " . count($kelasid_arr) . '<br>';
            $jumlah_siswa = Siswa::where('tipekelas_id',$kelasid_arr[$i])->count();
            $siswa = Siswa::where('tipekelas_id',$kelasid_arr[$i])->get();
            echo "Jumlah Siswa : " . $jumlah_siswa . '<br>' ;
            foreach($siswa as $s)
            {
                array_push($jumlah_siswa_arr, $s->id);
            }
        }

        for($x=0; $x<count($jumlah_siswa_arr); $x++)
        {
            $tagihan = new Tagihan;
            $tagihan->siswa_id = $jumlah_siswa_arr[$x];
            $tagihan->tipetagihan_id = $tipetagihan_id;
            $tagihan->sudah_dibayar = 0;
            $tagihan->keterangan = "blm_lunas";
            $tagihan->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $tagihan->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $tagihan->save();
        }

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Tipe Tagihan Berhasil Ditambah!',
            'alert-type' => 'success'
        );

        return redirect('data/tipetagihan')->with($notification);
    }

    public function update(Request $request, $slug)
    {
        $tipetagihan = TipeTagihan::where('slug',$slug)->first();
        $tipetagihan->nama_tagihan = $request->nama_tagihan;
        $tipetagihan->slug = Str::slug($request->nama_tagihan);
        $tipetagihan->nominal = $request->nominal;
        $tipetagihan->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $tipetagihan->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $tipetagihan->update();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Tipe Tagihan Berhasil Diubah!',
            'alert-type' => 'success'
        );

        return redirect('data/tipetagihan')->with($notification);
    }

    public function destroy($id)
    {
        $tipetagihan = TipeTagihan::find($id)->delete();
        $tagihan = Tagihan::where('tipetagihan_id',$id)->get()->each->delete();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Tipe Tagihan Berhasil Dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}