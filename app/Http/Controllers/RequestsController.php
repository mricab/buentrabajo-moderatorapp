<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class RequestsController extends Controller
{
    static $URL = 'http://127.0.0.1:8000/api';

    /**
     * Requests index
     */
    public function index() {

        //HTTP Post request
        $fullUrl = self::$URL . '/requests/index';
        $response = Http::get($fullUrl);
        $contents = json_decode($response, true);

        //return $contents;
        // Return
        if($contents['success']) {
            $suppliers = $contents['suppliers'];
            $supplies = $contents['supplies'];
            $schedules = $contents['schedules'];
            $cities = $contents['cities'];
            $services = $contents['services'];
            return view('requests.index', compact('suppliers', 'supplies', 'schedules', 'cities', 'services'));
        } else {
            return 'Error';
        }
    }
}
