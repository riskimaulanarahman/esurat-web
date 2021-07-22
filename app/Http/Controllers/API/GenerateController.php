<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Kode;

class GenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Kode::all();

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
        $getdate = Carbon::today();
        
        try {
            $checkdate = Kode::whereDate('created_at','=',$getdate)->count();
            
            if($checkdate < 1) {  
                
                $request->validate([
                    'status' => 'required',
                ]);
                $data = Kode::create([
                    'kode' => Str::random(12),
                    'status' => $request->status,
                ]);
                return response()->json(["status" => "success", "message" => "Berhasil Menambahkan Data"]);
            } else {
                return response()->json(["status" => "error", "message" => "data sudah di buat hari ini"]);
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
    public function show()
    {
        return view('generate-qr');
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
        try {

            $request->validate([
                'status' => 'required',
            ]);
    
            $data = Kode::findOrFail($id);
            $data->update([
                'kode' => Str::random(12),
                'status' => $request->status,
            ]);
            $data->save();
            
            return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Kode::findOrFail($id);
            $data->delete();

            return response()->json(["status" => "success", "message" => "Berhasil Hapus Data"]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
