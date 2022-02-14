<?php

namespace App\Http\Controllers;

use App\User;
use App\Barang;
use App\Pesanan;
use App\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $barang = Barang::where('barang_id', $id)->first();

        return view('pesan.index', compact('barang'));
    }

    public function pesan(Request $request, $id)
    {
        $barang = Barang::where('barang_id', $id)->first();
        $tanggal = Carbon::today();

        //validasi jumlah pesanan > stok barang
        if ($request->jumlah_pesan > $barang->stok) {
            alert()->error('Stok barang kurang!', 'Ups!');
            return redirect('pesan/' . $id);
        }

        $cek_pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 0)->first();
        //simpan ke tabel pesanan
        if (empty($cek_pesanan)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->user_id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 0)->first();

        //validasi agar ketika memesan barang yang sama tidak membuat row baru
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->barang_id)->where('pesanan_id', $pesanan_baru->pesanan_id)->first();

        //simpan ke tabel pesanan_detail
        if (empty($cek_pesanan_detail)) {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->barang_id;
            $pesanan_detail->pesanan_id = $pesanan_baru->pesanan_id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->save();
        } else {
            $pesanan_detail = PesananDetail::where('barang_id', $barang->barang_id)->where('pesanan_id', $pesanan_baru->pesanan_id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $barang->harga * $request->jumlah_pesan;
        $pesanan->update();

        alert()->success('Selamat! pesanan kamu berhasil dibuat ', 'Berhasil !');
        return redirect('check-out');
    }
    public function check_out()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 0)->first();
        $pesanan_details = [];
        if (!empty($pesanan)) {
            $pesanan_details = $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->get();
        }
        $admin = User::where('roles', 'ADMIN')->first();

        return view('pesan.check_out', compact('pesanan', 'pesanan_details', 'admin'));
    }

    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('detail_id', $id)->first();

        $pesanan = Pesanan::where('pesanan_id', $pesanan_detail->pesanan_id)->first();

        $pesanan_detail->delete();
        $pesanan->delete();


        alert()->error('Pesanan kamu dihapus', 'Terhapus !');
        return redirect('check-out');
    }

    public function konfirmasi(Request $request)
    {

        $user = User::where('user_id', Auth::user()->user_id)->first();

        if (empty($user->alamat)) {
            alert()->error('Wah kamu belum isi alamat', 'Check out gagal:(');
            return redirect('profile');
        }

        if (empty($user->no_hp)) {
            alert()->error('Wah kamu belum isi nomor hp', 'Check out gagal:(');
            return redirect('profile');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 0)->first();
        $this->validate($request, [
            'bukti' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);

        $nm = $request->bukti;
        $namaFile = time() . rand(10, 99) . "." . $nm->getClientOriginalExtension();

        $pesanan_id = $pesanan->pesanan_id;
        $pesanan->status = 1;
        $pesanan->bukti = $namaFile;

        if ($request->bukti) {
            $nm->move(public_path() . '/transfer', $namaFile);
        }

        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pd) {
            $barang = Barang::where('barang_id', $pd->barang_id)->first();
            $barang->stok = $barang->stok - $pd->jumlah;
            $barang->update();
        }

        alert()->success('Selamat! Kamu berhasil check out, silahkan lanjutkan proses pembayaran ', 'Berhasil !');
        return redirect('history/' . $pesanan_id);
    }
}
