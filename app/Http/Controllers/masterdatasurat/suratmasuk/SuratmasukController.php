<?php

namespace App\Http\Controllers\masterdatasurat\suratmasuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\SuratMasuk;
use App\Karyawan;
// use DateTime;

class SuratmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = SuratMasuk::all();

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
        $date = $request->tgl_surat;
        $fixed = date('Y-m-d', strtotime(substr($date,0,10)));
        $date2 = $request->tgl_diterima;
        $fixed2 = date('Y-m-d', strtotime(substr($date2,0,10)));

        $requestData = $request->all();
        if($date) {
            $requestData['tgl_surat'] = $fixed;
        }
        if($date2) {
            $requestData['tgl_diterima'] = $fixed2;
        }
        
        try {
            SuratMasuk::create($requestData);

            return response()->json(["status" => "success", "message" => "Berhasil Menambahkan Data"]);

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
        $karyawan = Karyawan::select('id_karyawan','nama_karyawan','nik')->pluck('nik','nama_karyawan');
        return view('pages/masterdata/masterdatasurat/suratmasuk/suratmasuk',[
            "karyawan" => $karyawan
        ]);
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

        $check = SuratMasuk::where('id_surat_masuk',$id)->first();
        if($check->status !== 0) {
            return response()->json(["status" => "error", "message" => "dalam status pengajuan, aksi tidak di izinkan"]);
        } else {
            $date = $request->tgl_surat;
            $fixed = date('Y-m-d', strtotime(substr($date,0,10)));
            $date2 = $request->tgl_diterima;
            $fixed2 = date('Y-m-d', strtotime(substr($date2,0,10)));

            $requestData = $request->all();
            if($date) {
                $requestData['tgl_surat'] = $fixed;
            }
            if($date2) {
                $requestData['tgl_diterima'] = $fixed2;
            }
            
            try {
                $data = SuratMasuk::findOrFail($id);
                $data->update($requestData);

                return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);

            } catch (\Exception $e){

                return response()->json(["status" => "error", "message" => $e->getMessage()]);
            }
            //
        }
    }

    public function updateandroid(Request $request, $id)
    {
        return $id;
        $check = SuratMasuk::where('id_surat_masuk',$id)->first();
        if($check->status !== 0) {
            return response()->json(["status" => "error", "message" => "dalam status pengajuan, aksi tidak di izinkan"]);
        } else {
            $date = $request->tgl_surat;
            $fixed = date('Y-m-d', strtotime(substr($date,0,10)));
            $date2 = $request->tgl_diterima;
            $fixed2 = date('Y-m-d', strtotime(substr($date2,0,10)));

            $requestData = $request->all();
            if($date) {
                $requestData['tgl_surat'] = $fixed;
            }
            if($date2) {
                $requestData['tgl_diterima'] = $fixed2;
            }
            
            try {
                $data = SuratMasuk::findOrFail($id);
                $data->update($requestData);

                return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);

            } catch (\Exception $e){

                return response()->json(["status" => "error", "message" => $e->getMessage()]);
            }
            //
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
            $check = SuratMasuk::where('id_surat_masuk',$id)->first();
            if($check->status !== 0) {
                return response()->json(["status" => "error", "message" => "dalam status pengajuan, aksi tidak di izinkan"]);
            } else {
                $data = SuratMasuk::where('id_surat_masuk',$id)->delete();

                return response()->json(["status" => "success", "message" => "Berhasil Hapus Data"]);
            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function checksuratmasuk($id)
    {
        try {
            $data = SuratMasuk::where('id_surat_masuk',$id)->first();
            if($data->status !== 0) {
                return 1;
            } else {
                return 0;
            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
