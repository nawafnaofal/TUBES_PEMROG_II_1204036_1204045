<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pesanan;
use App\PesananDetail;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()  // masuk ke halaman ini harus login
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //mengambil pesanan yang isi dari status nya tidak 0
        $pesanans = Pesanan::where('user_id', Auth::user()->user_id)->where('status', '!=', 0)->get();
        $jp1 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 1)->orwhere('status', 5)->get();
        $jp2 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 2)->get();
        $jp3 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 3)->get();
        $jp4 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 4)->get();

        $p1 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 1)->orwhere('status', 5)->first();
        $p2 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 2)->first();
        $p3 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 3)->first();
        $p4 = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 4)->first();
        return view('history.index', compact('pesanans', 'jp1', 'jp2', 'jp3', 'jp4', 'p1', 'p2', 'p3', 'p4'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->get();


        return view('history.detail', compact('pesanan', 'pesanan_details'));
    }

    public function konfirmasipesanan($id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->where('status', 2)->first();
        $pesanan_id = $pesanan->pesanan_id;
        $pesanan->status = 3;
        $pesanan->update();

        alert()->success('Pesanan mu selesai ', 'Selamat !');
        return redirect('history/' . $pesanan_id);
    }

    public function batal($id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->where('status', 1)->first();
        $pesanan_id = $pesanan->pesanan_id;
        $pesanan->status = 5;
        $pesanan->update();

        alert()->success('Pesanan mu akan dibatalkan oleh admin segera', 'Berhasil !');
        return redirect('history/' . $pesanan_id);
    }
}
