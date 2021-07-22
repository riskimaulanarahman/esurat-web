<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Jabatan;

class ListController extends Controller
{
    public function listJabatan() {
        return Jabatan::select('id_jabatan','nama_jabatan')->get();
    }

    public function getlogin(Request $req)
    {   
        $check = DB::table('users')->select('username','email','password')
        ->where('email',$req->email)
        ->first();

        if($check) { 
            if (Hash::check($req->password, $check->password))
            {
                $data = 200;
            } else {
                $data = 404;
            }
        } else {
            $data = 0;
        }

        return response()->json($data);
    }
}