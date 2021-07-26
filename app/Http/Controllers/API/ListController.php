<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Jabatan;
use App\SuratMasuk;
use App\SuratKeluar;
use App\Disposisi;
use Illuminate\Support\Carbon;


class ListController extends Controller
{
    public function listJabatan() {
        return Jabatan::select('id_jabatan','nama_jabatan')->get();
    }

    public function getlogin(Request $req)
    {   

        $check = DB::table('users')->select('username','email','password','role','nik')
        ->where('email',$req->email)
        ->first();

        if($check) { 
            if (Hash::check($req->password, $check->password))
            {
                $data = [
                    "status" => 200,
                    "data" => $check
                ];
            } else {
                $data = ["status" => 404];
            }
        } else {
            $data = ["status" => 0];
        }

        return response()->json($data);
    }

    public function alluser(Request $req)
    {   

        $check = DB::table('users')->select('username','email','role','nik')
        ->get();

        return response()->json($check);
    }

    public function checkusernik(Request $req, $email)
    {   

        $check = DB::table('users')->select('username','email','role','nik')
        ->where('email',$email)
        ->first();

        // if($check) { 
        //     if (Hash::check($req->password, $check->password))
        //     {
        //         $data = [
        //             "status" => 200,
        //             "data" => $check
        //         ];
        //     } else {
        //         $data = ["status" => 404];
        //     }
        // } else {
        //     $data = ["status" => 0];
        // }

        return response()->json($check);
    }

    public function dashboardadmin(Request $request){
      
        $alldisposisi = Disposisi::select('*')
        ->where('nik',$request->nik)
        ->count();
        $nosm = Disposisi::select('*')
        ->whereNotNull('id_surat_masuk')
        ->where('nik',$request->nik)
        ->where('status',1)
        ->count();
        $nosk = Disposisi::select('*')
        ->whereNotNull('id_surat_keluar')
        ->where('nik',$request->nik)
        ->where('status',1)
        ->count();

        $data = [
            "alldisposisi" => $alldisposisi,
            "nosm" => $nosm,
            "nosk" => $nosk,
        ];

        return response()->json($data);
    }
}
