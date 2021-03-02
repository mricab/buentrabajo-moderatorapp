<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class RequestsController extends Controller
{
    static $URL = 'http://127.0.0.1:8000/api';


    /**
     * Start
     */
    public function start(Request $request)
    {
        $request->session()->forget('types');
        $request->session()->forget('start');
        $request->session()->forget('end');
        $request->session()->forget('elements');
        $request->session()->forget('modified');
        $request->session()->forget('isOldQuerySet');
        return redirect('/requests/index');
    }


    /**
     * Requests index
     */
    public function index(Request $request) {

        // HTTP request: parameters data
        $fullUrl = self::$URL . '/parameters/all';
        $response = Http::get($fullUrl);
        $contents = json_decode($response, true);

        // Save Parameters
        if($contents['success']) {
            $schedules = $contents['schedules'];
            $cities = $contents['cities'];
            $services = $contents['services'];
            $dates_range = $contents['requests_dates_range'];
            $types = $contents['requests_types'];
        } else {
            return 'Parameters: error';
        }


        //Set query and save it in session
        $oldQuery = session('isOldQuerySet', false);
        $currentQuery = $request->has('selEnd');
        if($currentQuery) {
            $query = [
                'types'    => $request->input('selTypes'),
                'start'    => $request->input('selStart'),
                'end'      => $request->input('selEnd'),
                'elements' => $request->input('elements'),
                'modified' => ($request->has('page')) ? session('modified') : [],
                'page'     => $request->input('page') ?? '0',
            ];
            $request->session()->forget('modified');
        } elseif($oldQuery) {
            $currentPage = $request->input('page');
            $query = [
                'types'    => session('types'),
                'start'    => session('start'),
                'end'      => session('end'),
                'elements' => session('elements'),
                'modified' => session('modified'),
                'page'     => session('page'),
            ];
        } else {
            $query = [
                'types'    => [$types[0]],
                'start'    => $dates_range['min'],
                'end'      => $dates_range['max'],
                'elements' => '3',
                'modified' => [],
                'page'     => '0',
            ];
        }
        session($query); session(['isOldQuerySet' => true]);

        // HTTP request: Suppliers data
        $fullUrl = self::$URL . '/requests/index';
        $response = Http::post($fullUrl, $query);
        $contents = json_decode($response, true);

        // Return
        if($contents['success']) {
            $suppliers = $contents['suppliers'];
            $supplies = $contents['supplies'];
            $currentPage = $query['page'];
            $pages = $contents['pages'];
            return view('requests.index', compact('suppliers', 'supplies', 'schedules', 'cities', 'services', 'types', 'dates_range', 'currentPage', 'pages'));
        } else {
            //return $response;
            return "Index: Error";
        }
    }


    /**
     * Update Request State
     */
    public function accept(Request $request)
    {
        //Get Id
        $id = $request->input('supplier_id');

        //HTTP Post request
        $fullUrl = self::$URL . '/requests/accept';
        $response = Http::post($fullUrl, ['id' => $id]);
        $contents = json_decode($response, true);

        //Return
        if($contents['success']) {
            $request->session()->push('modified', $id);
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'No se pudo actualizar el estado.');
        }
    }

    /**
     * Update Request State
     */
    public function reject(Request $request)
    {
        //Get Id
        $id = $request->input('supplier_id');

        //HTTP Post request
        $fullUrl = self::$URL . '/requests/reject';
        $response = Http::post($fullUrl, ['id' => $id]);
        $contents = json_decode($response, true);

        //Return
        if($contents['success']) {
            $request->session()->push('modified', $id);
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'No se pudo actualizar el estado.');
        }
    }

}
