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

    public function detail($id)
    {
        $data = Pembayaran::find($id);

        if($data->keterangan=='blm_lunas')
        {
            $ket = 'Belum Lunas';
        } else {
            $ket = 'Lunas';
        }
        
        $content = '<h2 style="text-align:left; margin-bottom:20px; font-weight:500;">Detail Pembayaran</h2>';
        $content .= '<table>';
        $content .= '<tr style="text-align:left;">';
        $content .= '<td class="exceptt">NIS</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt">' . $data->tagihan->siswa->autentikasi->nomor_induk ?? "" . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="text-align:left;">';
        $content .= '<td class="exceptt">Nama Siswa</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt">' . $data->tagihan->siswa->nama_siswa ?? "" . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="text-align: left;">';
        $content .= '<td class="exceptt">Kelas</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt">' . $data->kelas->nama_kelas ?? "" . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="text-align: left; margin-top: 5px;">';
        $content .= '<td class="exceptt">Jenis Tagihan</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt">' . $data->tagihan->tipetagihan->nama_tagihan ?? "" . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="text-align: left; margin-top: 5px;">';
        $content .= '<td class="exceptt">Petugas Pemeriksa</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt">' . $data->petugas->nama_petugas ?? "" . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="text-align: left; margin-top: 5px;">';
        $content .= '<td class="exceptt">Uang Diterima</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt">Rp. ' . $data->nominal ?? "" . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="text-align: left; margin-top: 5px;">';
        $content .= '<td class="exceptt">Sisa Tagihan</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt">Rp. ' . $data->sisa_tagihan ?? "" . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="text-align: left; margin-top: 5px;">';
        $content .= '<td class="exceptt">Keterangan</td>';
        $content .= '<td class="exceptt" width="20" align="center">:</td>';
        $content .= '<td class="exceptt" class="text-capitalize">' . $ket . '</td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= '<a href="/data/siswa/detail/' . $data->tagihan->siswa->slug . '/' . $data->tagihan->siswa->id .'" jenis="" class="btn text-light w-100 btn-generate" style="margin-bottom:7px; margin-top: 30px; background: #2C2E3E;">Lihat Data Pembayaran</a>';
        
        echo json_encode($content);
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
            $status = '';
            if($t->keterangan=='lunas'){
                $status = 'disabled';
            }
            $output .= "<option " . $status . " value='" . $t->id . "'>" . $t->tipetagihan->nama_tagihan . "</option>";
        }
        return $output;
    }

    public function fetchSisaTagihan($tipetagihan)
    {
        $tagihan = Tagihan::find($tipetagihan);
        $output = "<p style='font-size: 15px; margin-bottom: -10px !important;'>Sisa Tagihan : Rp. " . ($tagihan->tipetagihan->nominal - $tagihan->sudah_dibayar) . "</p>";
        return $output;
    }

    public function history()
    {
        $tipetagihan = TipeTagihan::all();
        $id = Auth::user()->id;
        $history = Pembayaran::orderBy('id', 'DESC')->get();
        $history_siswa = Pembayaran::where('siswa_id',$id)->orderBy('id', 'DESC')->get();
        return view('pages.history', compact(['history','history_siswa','tipetagihan','kelas']));
    }

    public function store(Request $request)
    {
        $tagihan = Tagihan::find($request->jenis_pembayaran);
        $tipetagihan = $tagihan->tipetagihan->nominal;
        $sudahdibayar = $tagihan->sudah_dibayar;

        if($tipetagihan - ($request->nominal+$sudahdibayar)==0)
        {
            $ket = 'lunas';
        } else {
            $ket = 'blm_lunas';
        }

        $entri = new Pembayaran;
        $entri->nominal = $request->nominal;
        $entri->siswa_id = $request->nama_siswa;
        $entri->petugas_id = Auth::user()->petugas->id;
        $entri->kelas_id = $request->kelas_id;
        $entri->tagihan_id = $request->jenis_pembayaran;
        $entri->keterangan = $ket;
        $entri->sisa_tagihan = $tipetagihan - ($request->nominal+$sudahdibayar);
        $entri->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $entri->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $entri->save();

        if($tipetagihan - ($request->nominal+$sudahdibayar)==0)
        {
            $tagihan = Tagihan::find($request->jenis_pembayaran);
            $tagihan->keterangan = 'lunas';
            $tagihan->update();
        }

        $notification = array(
            'title' => 'Berhasil',
            'description' => 'Pembayaran Berhasil!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function data()
    {
        $tagihan = Tagihan::where('siswa_id', Auth::user()->id)->where('tipetagihan_id','>=','6')->get();
        $tagihan_spp = Tagihan::where('siswa_id', Auth::user()->id)->whereBetween('tipetagihan_id', [1, 5])->get();
        $siswa = Siswa::find(Auth::user()->id);
        $history = Pembayaran::where('siswa_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('pages.datapembayaran', compact(['siswa','history','tagihan_spp','tagihan']));
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
