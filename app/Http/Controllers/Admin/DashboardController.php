<?php

namespace App\Http\Controllers\Admin;

use App\Barang;
use App\Category;
use App\Pesanan;
use App\User;
use \Auth;
use Alert;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;


class DashboardController extends Controller
{

    // view controller
    public function index()
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        $pesanan = Pesanan::where('status', 1)->orWhere('status', 5)->get();
        $sending = Pesanan::where('status', 2)->get();
        $histori = Pesanan::where('status', 3)->get();
        $barang = Barang::all();
        $users = User::where('roles', null)->get();
        $kategori = Category::all();

        return view('admin.dashboard', [
            'user' => $user,
            'pelanggan' => $users,
            'pesanan' => $pesanan,
            'histori' => $histori,
            'barang' => $barang,
            'kategori' => $kategori,
            'sending' => $sending,

        ]); // handle ke halaman dashboard dengan menggunakan tabel users
    }

    public function databarang()
    {
        $barangs = Barang::with('category')->get();

        $kategori = Category::all();

        return view('admin.barang', [
            'barangs' => $barangs,
            'kategori' => $kategori
        ]);
    }

    public function datakategori()
    {
        $kategori = Category::all();

        return view('admin.kategori', compact('kategori'));
    }

    public function pesananmasuk()
    {
        $pesanans = Pesanan::where('status', 1)->orWhere('status', 2)->orWhere('status', 5)->with(['user'])->first();
        $pesanan = Pesanan::where('status', 1)->orWhere('status', 2)->orWhere('status', 5)->with(['user'])->get();

        $kategori = Category::all();

        return view('admin.pesananmasuk', compact('pesanan', 'kategori', 'pesanans'));
    }

    public function historipesanan()
    {
        $notif = Pesanan::where('penerima', NULL)->first();
        $pesanan = Pesanan::where('status', 3)->orWhere('status', 4)->with(['user'])->get();
        $kategori = Category::all();

        return view('admin.historipesanan', [
            'pesanan' => $pesanan,
            'kategori' => $kategori,
            'notif' => $notif,

        ]);
    }

    public function pelanggan()
    {
        $user = User::where('roles', NULL)->get();
        $kategori = Category::all();

        return view('admin.pelanggan', [
            'user' => $user,
            'kategori' => $kategori
        ]);
    }

    public function editbarang($id)
    {
        $update = Barang::findorfail($id);

        $kategori = Category::all();

        return view('admin.editbarang', [
            'update' => $update,
            'kategori' => $kategori
        ]);
    }

    public function detailpesanan($id)
    {

        $pesanan = Pesanan::with(['user'])->findorfail($id);

        $alert = Pesanan::where('pesanan_id', $id)->first();

        $detailpesanan = PesananDetail::where('pesanan_id', $id)->with('barang')->get();

        return view('admin.detailpesanan', [
            'detail' => $detailpesanan,
            'pesanan' => $pesanan,
            'alert' => $alert,
        ]);
    }

    public function adminprofile()
    {
        // dd('done');
        $user = User::where('user_id', Auth::user()->user_id)->first();

        return view('admin.adminprofile', compact('user'));
    }
    // view controller end


    // create controller 
    public function simpankategori(Request $request)
    {
        $validatedData = $request->validate([
            'categories_id' => 'bail',
            'nama' => 'required|unique:categories|max:15',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        alert()->success('Kategori baru berhasil ditambahkan !', 'Berhasil !');
        return redirect('kategori');
    }

    public function simpanbarang(Request $request)
    {
        $validatedData = $request->validate([
            'categories_id' => 'required',
            'nama_barang' => 'required|unique:barangs|max:15',
            'gambar' => 'mimes:jpeg,jpg,png,gif|required|unique:barangs|max:10000',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required|unique:barangs|max:200',
        ]);

        $nm = $request->gambar;
        $namaFile = time() . rand(10, 99) . "." . $nm->getClientOriginalExtension();

        $upload = new Barang();
        $upload->categories_id = $request->categories_id;
        $upload->nama_barang = $request->nama_barang;
        $upload->gambar = $namaFile;
        $upload->harga = $request->harga;
        $upload->stok = $request->stok;
        $upload->keterangan = $request->keterangan;

        $nm->move(public_path() . '/uploads', $namaFile);
        $upload->save();

        alert()->success('Barang baru berhasil ditambahkan !', 'Berhasil !');
        return redirect('barang');
    }
    // create controller end

    // update controller
    public function ubahbarang(Request $request, $id)
    {

        $validatedData = $request->validate([
            'categories_id' => 'required',
            'nama_barang' => 'required|max:15',
            'gambar' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required|max:255',
        ]);

        $ubah = Barang::findorfail($id);
        $awal = $ubah->gambar;

        $update = [
            'categories_id' => $request['categories_id'],
            'nama_barang' => $request['nama_barang'],
            'gambar' => $request->$awal,
            'harga' => $request['harga'],
            'stok' => $request['stok'],
            'keterangan' => $request['keterangan'],
        ];
        if ($request->gambar) {
            $request->gambar->move(public_path() . '/uploads', $awal);
        }

        $ubah->update($update);

        alert()->success('Informasi barang diperbarui !', 'Berhasil !');
        return redirect('barang');
    }

    public function antarpesanan($id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->where('status', 1)->orWhere('status', 5)->first();
        $pesanan_id = $pesanan->pesanan_id;
        $pesanan->status = 2;
        $pesanan->update();

        alert()->success('Pesanan akan diantar ', 'Berhasil !');
        return redirect('pesananmasuk');
    }

    public function editprofile(Request $request)
    {
        $this->validate($request, [
            'password'  => 'confirmed',
        ]);

        $user = User::where('user_id', Auth::user()->user_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->rekening = $request->rekening;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        alert()->success('Profile mu terupdate !', 'Berhasil !');
        return redirect('adminprofile');
    }

    public function selesai($id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->where('status', 2)->first();
        $pesanan_id = $pesanan->pesanan_id;
        $pesanan->status = 3;
        $pesanan->update();

        alert()->success('Pesanan mu selesai ', 'Selamat !');
        return redirect('historipesanan');
    }

    public function tambahpenerima(Request $request, $id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->first();

        $this->validate($request, [
            'penerima' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);

        $nm = $request->penerima;
        $namaFile = time() . rand(10, 99) . "." . $nm->getClientOriginalExtension();

        $pesanan->penerima = $namaFile;

        if ($request->penerima) {
            $nm->move(public_path() . '/penerima', $namaFile);
        }
        $pesanan->update();

        alert()->success('Data penerima ditambahkan', 'Berhasil !');
        return redirect('historipesanan');
    }

    public function batalpesanan(Request $request, $id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->first();
        $pesanan_id = $pesanan->pesanan_id;
        $pesanan->status = 4;
        $pesanan->keterangan = $request->keterangan;
        $pesanan->update();

        alert()->success('Pesanan dibatalkan ', 'Berhasil !');
        return redirect('historipesanan');
    }
    // update controller end

    // delete controller
    public function hapusbarang($id)
    {
        $barang = Barang::where('barang_id', $id)->first();
        $barang->delete();

        alert()->error('Barang dihapus', 'Terhapus !');
        return redirect('barang');
    }


    // delete controller end
}
