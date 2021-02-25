<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;


class AuthenticationController extends Controller
{
    static $URL = 'http://127.0.0.1:8000/api';

    /**
     * Login
     */
    public function login(Request $request)
    {
        // Validation
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //HTTP Post request
        $fullUrl = self::$URL . '/login';

        $response = Http::post($fullUrl, [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $contents = json_decode($response, true);

        // Return
        if($contents['success']) {
            session(['token' => $contents['token']]);
            return redirect('/requests/index');
        } else {
            return redirect()->back()->withInput()->with('message', 'Usuario inválido.');
        }
    }
}
