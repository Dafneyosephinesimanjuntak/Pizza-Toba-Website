<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('do_logout');
    }
    public function index()
    {
        return view('pages.web.auth.main');
    }
    public function do_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('username')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('username'),
                ]);
            } else {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $user = User::where('username', $request->username)->where('role', '=', 'user')->first();
        if ($user) {
            if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                return response()->json([
                    'alert' => 'success',
                    'message' => 'Welcome back ' . Auth::guard('web')->user()->name,
                    'callback' => 'reload',
                ]);
            } else {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Maaf, password anda salah.',
                ]);
            }
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, Akun belum terdaftar.',
            ]);
        }
    }
    public function do_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required|username|max:255',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('fullname')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('fullname'),
                ]);
            } elseif ($errors->has('username')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('username'),
                ]);
            } elseif ($errors->has('password')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            } elseif ($errors->has('password_confirmation')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password_confirmation'),
                ]);
            }
        }

        $user = new User;
        $user->name = explode(' ', $request->fullname)[0];
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Registrasi Berhasil',
            'callback' => 'reload',
        ]);
    }
    public function do_logout()
    {
        $user = Auth::guard('web')->user();
        Auth::logout($user);
        return redirect('/');
    }
}
