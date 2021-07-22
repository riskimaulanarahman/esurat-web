<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index() {
        $response = Http::get('http://api.plos.org/search?q=title:DNA');

        $data = $response['response']['docs'];
        return view('test',[
            'data' => $data
        ]);

    }
}
