<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barangs = Barang::all();
        $kategori = Category::all();
        return view('home', compact('barangs', 'kategori'));
    }

    public function display($id)
    {
        $display = Barang::where('categories_id', $id)->get();
        $kategori = Category::all();

        return view('home', [
            'barangs' => $display,
            'kategori' => $kategori
        ]);
    }
}
