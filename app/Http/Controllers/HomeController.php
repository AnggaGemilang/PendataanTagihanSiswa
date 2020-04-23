<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $id = '';

        if(Auth::user()->role_id=="1")
        {
            $id = Auth::user()->siswa->id;
        }
        
        $history = Pembayaran::orderBy('id', 'DESC')->get();
        $history_siswa = Pembayaran::where('siswa_id',$id)->orderBy('id', 'DESC')->get();
        $today_time = Carbon::now()->toDateString();
        $history = Pembayaran::where('created_at', 'like', '%' . $today_time . '%')->orderBy('id', 'DESC')->get();
        $countbayar = $history->count();
        return view('pages.home', compact(['history','countbayar','history','history_siswa']));
    }

    public function profile()
    {
        return view('pages.profil');
    }
}
