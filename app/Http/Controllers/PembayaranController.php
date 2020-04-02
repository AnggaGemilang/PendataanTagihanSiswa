<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Kelas;
use App\Siswa;
use App\TipeTagihan;
use App\Tagihan;
use App\Pembayaran;
use Auth;
use PDF;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelas = Kelas::all();
        $tipetagihan = TipeTagihan::all();
        $siswa = Siswa::all();
        return view('pages.entripembayaran', compact(['kelas','tipetagihan','siswa']));
    }

    public function fetch($kelas_id)
    {
        $kelas = Kelas::find($kelas_id);
        $output = "<option value=''>Pilih Siswa</option>";
        foreach($kelas->students as $student)
        {
            $output .= "<option value='" . $student->id . "'>" . $student->nama_siswa . "</option>";
        }
        return $output;
    }

    public function fetchTagihan($siswa_id)
    {
        $tagihan = Tagihan::where('siswa_id', $siswa_id)->get();
        $output = "<option value=''>Pilih Pembayaran</option>";
        foreach($tagihan as $t)
        {
            $output .= "<option value='" . $t->id . "'>" . $t->tipetagihan->nama_tagihan . "</option>";
        }
        return $output;
    }

    public function history()
    {
        $id = Auth::user()->id;
        $history = Pembayaran::orderBy('id', 'DESC')->get();
        $history_siswa = Pembayaran::where('siswa_id',$id)->orderBy('id', 'DESC')->get();
        return view('pages.history', compact(['history','history_siswa']));
    }

    public function store(Request $request)
    {
        $entri = new Pembayaran;
        $entri->nominal = $request->nominal;
        $entri->siswa_id = $request->nama_siswa;
        $entri->petugas_id = Auth::user()->id;
        $entri->kelas_id = $request->kelas_id;
        $entri->tagihan_id = $request->jenis_pembayaran;
        $entri->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $entri->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $entri->save();

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Pembayaran Berhasil!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function data()
    {
        $tagihan = Tagihan::where('siswa_id', Auth::user()->id )->where('tipetagihan_id','>=','2')->get();
        $tagihan_spp = Tagihan::where('siswa_id', Auth::user()->id)->where('tipetagihan_id','1')->get();
        $siswa = Siswa::find(Auth::user()->id);
        $history = Pembayaran::where('siswa_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('pages.datapembayaran', compact(['siswa','history','tagihan_spp','tagihan']));
    }

    public function test()
    {
        $pembayaran = Pembayaran::all();
        return view('layouts.report',['pembayaran'=>$pembayaran]);        
    }

    public function cetak_pdf($jenis_filter, $periode)
    {
        $jenisfilter = '';
        if($jenis_filter=="jenis_perbulan")
        {
            $jenisfilter = 'Perbulan';
            $bulan = '';
            if($periode=="Januari")
            {
                $bulan = '01';                
            }else if($periode=="Februari")
            {
                $bulan = '02';                
            }else if($periode=="Maret")
            {
                $bulan = '03';                
            }else if($periode=="April")
            {
                $bulan = '04';                
            }else if($periode=="Mei")
            {
                $bulan = '05';                
            }else if($periode=="Juni")
            {
                $bulan = '06';                
            }else if($periode=="Juli")
            {
                $bulan = '07';                
            }else if($periode=="Agustus")
            {
                $bulan = '08';                
            }else if($periode=="September")
            {
                $bulan = '09';                
            }else if($periode=="Oktober")
            {
                $bulan = '10';                
            }else if($periode=="November")
            {
                $bulan = '11';                
            }else if($periode=="Desember")
            {
                $bulan = '12';                
            }
            $pembayaran = Pembayaran::where('created_at','like','%-'.$bulan.'-%')->get();
        }else if($jenis_filter=="jenis_triwulan")
        {
            $jenisfilter = 'Triwulan';
            $from = '';
            $to = '';
            if($periode=="Januari-Februari-Maret")
            {
                $from = '2020-01-01';
                $to = '2020-03-31';
            }else if($periode=="April-Mei-Juni")
            {
                $from = '2020-04-01';
                $to = '2020-06-30';
            }else if($periode=="Juli-Agustus-September")
            {
                $from = '2020-07-01';
                $to = '2020-09-30';
            }else if($periode=="Oktober-November-Desember")
            {
                $from = '2020-10-01';
                $to = '2020-12-31';
            }
            $pembayaran = Pembayaran::whereBetween('created_at',[$from,$to])->get();
        }else if($jenis_filter=="jenis_semester")
        {
            $jenisfilter = 'Semester';
            $from = '';
            $to = '';
            if($periode=="Januari-Februari-Maret-April-Mei-Juni")
            {
                $from = '2020-01-01';
                $to = '2020-06-31';
            }else if($periode=="Juli-Agustus-September-Oktober-November-Desember")
            {
                $from = '2020-07-01';
                $to = '2020-12-31';
            }
            $pembayaran = Pembayaran::whereBetween('created_at',[$from,$to])->get();
        }else{
            $jenisfilter = 'Pertahun';
            $pembayaran = Pembayaran::where('created_at','like',$periode.'-%')->get();
        }

    	$pdf = PDF::loadview('layouts.report', compact(['jenisfilter','periode','pembayaran']));
    	return $pdf->download('laporan-pembayaran.pdf');
    }

}
