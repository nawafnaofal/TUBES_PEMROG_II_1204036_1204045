<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'string', 'min:12', 'max:15', 'unique:users'],
            'alamat' => ['required', 'string', 'min:40', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function emailver(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'string', 'min:12', 'max:15', 'unique:users'],
            'alamat' => ['required', 'string', 'min:40', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $registerData = $request->all();
        $email = $request->input('email');
        $code = random_int(100000, 999999);

        try {
            DB::table('email_verifications')->insert([
                'email' => $email,
                'code' => $code
            ]);

            //send email
            Mail::to($email)->send(new VerifyEmail($email, $code));

            alert()->success('Kode unik telah dikirim', 'Cek email anda !');
            return view('auth.emailver', ['registerData' => $registerData]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function verify(Request $request)
    {
        if (!$codeValidation = DB::table('email_verifications')->where('code', $request->input('vercode'))->first()) {
            $registerData = $request->all();
            alert()->error('Kode yang anda masukkan tidak sesuai', 'Ups!');
            return view('auth.emailver', ['registerData' => $registerData]);
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'no_hp' => $request['no_hp'],
            'alamat' => $request['alamat'],
            'password' => Hash::make($request['password']),
        ]);

        alert()->success('Akun kamu berhasil dibuat, selanjutnya cobalah untuk login', 'Selamat !');
        return view('auth.login');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
