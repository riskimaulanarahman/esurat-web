<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Absensi;
use App\User;
use DB;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        

        try {
            $user = Auth::user();

            if($user->role == 'guru') {
                $data = DB::table('vw_absensi')
                ->where('nip',$user->nip)
                ->get();
            } else  {
                $data = DB::table('vw_absensi')
                ->get();
            }
    

            return response()->json(['status' => "show", "message" => "Menampilkan Data" , 'data' => $data]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('report');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateabsensi(Request $request,$id,$day,$val)
    {
        // return [
        //     "id" => $id,
        //     "day" => $day
        // ];

        try {
            // $day = 
            // $month = 7;
    
            $data = Absensi::where('nip',$id)
            // ->whereRaw('month(created_at) = '.$month)
            ->whereRaw('DAY(created_at) = '.$day)
            ->first();

            if($data !== null) {

                
                $absensi = Absensi::where('id',$data->id)->first();
                $absensi->update([
                    "kehadiran" => $val
                ]);
                // return $data;
                return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);
            } else {
                // $absensi = new Absensi;
                return response()->json(["status" => "error", "message" => "Tidak Bisa Ubah Data"]);

            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => "Tidak Bisa Ubah Data"]);
        }
        // return $request->all();
        // try {
    
        //     $data = Absensi::findOrFail($request->id);

        //     // $absensi = new Absensi;
        //     // $absensi->kehadiran = 
        //     $data->update([
        //         "kehadiran" => $request->kehadiran
        //     ]);
        //     // return $data;
            
        //     return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);

        // } catch (\Exception $e){

        //     return response()->json(["status" => "error", "message" => $e->getMessage()]);
        // }
    }

    public function update(Request $request, $id, $day)
    {
        
        return [
            "id" => $id,
            "day" => $day
        ];

        // try {
        //     // $day = 
        //     $month = 7;
    
        //     $data = Absensi::where('nip',$id)
        //     // ->whereRaw('DAY(created_at) = '.$day)
        //     ->get();

        //     // $absensi = new Absensi;
        //     // $absensi->kehadiran = 
        //     // $data->update([
        //     //     "kehadiran" => $request['1']
        //     // ]);
        //     return $data;
            
        //     // return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);

        // } catch (\Exception $e){

        //     return response()->json(["status" => "error", "message" => $e->getMessage()]);
        // }
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
