<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Absensi;
use App\Kode;
use App\User;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $getkode = Kode::orderBy('created_at','desc')->first();

        if(isset($getkode)) {
            return view('absensi',[
                'kode' => $getkode->kode,
                'status' => $getkode->status
            ]);
        } else {
            return view('absensi');
        }
    }

    public function formabsensi($kode)
    {  
        $getkode = Kode::orderBy('created_at','desc')->first();

        if($getkode->kode == $kode) {
            return view('form-absensi',['status' => $getkode->status]);
        } else {
            return view('expired');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $checknip = User::where('nip',$request->nip)->where('role','guru')->count();

            if($checknip > 0) {

                if($request->status == 'masuk'){
                    $checkabsensi = Absensi::where('nip',$request->nip)->whereNotNull('jam_masuk')->whereDate('created_at',Carbon::today())->count();
                } else if($request->status == 'pulang') {
                    $checkabsensi = Absensi::where('nip',$request->nip)->whereNotNull('jam_keluar')->whereDate('created_at',Carbon::today())->count();
                    // if($checkabsensi < 1) {
                    //     return response()->json(["status" => "error", "message" => "Data Kosong, Anda Tidak Bisa Melakukan Absensi"]);
                    // }
                }

                if($checkabsensi < 1) {
                    
                    if($request->status == 'masuk'){
                        $data = new Absensi;
                    } else if($request->status == 'pulang') {
                        $data = Absensi::where('nip',$request->nip)->whereNull('jam_keluar')->whereDate('created_at',Carbon::today())->first();
                    }

                    $data->nip = $request->nip;
                    $data->kehadiran = $request->kehadiran;
                    if($request->status == 'masuk') {
                        $data->jam_masuk = Carbon::now();
                    } else if($request->status == 'pulang') {
                        $data->jam_keluar = Carbon::now();
                    }
                    $data->save();
                    
                    return response()->json(["status" => "success", "message" => "Berhasil Menambahkan Data"]);
                } else {
                    return response()->json(["status" => "error", "message" => "Anda Sudah Absen ".$request->status." Hari ini"]);
                }
            } else {
                return response()->json(["status" => "error", "message" => "NIP Tidak Ditemukan Atau Anda Bukan Guru"]);
            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
