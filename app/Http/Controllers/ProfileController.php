<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Alert;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        return view('profile.index', compact('user'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'password'  => 'confirmed',
        ]);

        $user = User::where('user_id', Auth::user()->user_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        alert()->success('Profile mu terupdate !', 'Berhasil !');
        return redirect('profile');
    }
}
