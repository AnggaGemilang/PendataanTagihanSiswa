<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $today_time =  Carbon::now()->toDateString();
        $history = Pembayaran::where('created_at', 'like', '%' . $today_time . '%')->orderBy('id', 'DESC')->get();
        $countbayar = $history->count();
        return view('pages.home', compact(['history','countbayar']));
    }

    public function profile()
    {
        return view('pages.profil');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}
