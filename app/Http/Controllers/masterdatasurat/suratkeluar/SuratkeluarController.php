<?php

namespace App\Http\Controllers\masterdatasurat\suratkeluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Karyawan;
use App\SuratKeluar;
use App\Disposisi;
use PDF;


class SuratkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = SuratKeluar::all();

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
        $date = $request->tgl_dibuat;
        $fixed = date('Y-m-d', strtotime(substr($date,0,10)));

        $requestData = $request->all();
        if($date) {
            $requestData['tgl_dibuat'] = $fixed;
        }
        
        try {
            SuratKeluar::create($requestData);

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

        return view('pages/masterdata/masterdatasurat/suratkeluar/suratkeluar',[
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
        $check = SuratKeluar::where('id_surat_keluar',$id)->first();
        if($check->status !== 0) {
            return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
        } else {
            $date = $request->tanggal_surat;
            $fixed = date('Y-m-d', strtotime(substr($date,0,10)));

            $requestData = $request->all();
            $requestData['tanggal_surat'] = $fixed;
            
            try {
                $data = SuratKeluar::findOrFail($id);
                $data->update($requestData);

                return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);

            } catch (\Exception $e){

                return response()->json(["status" => "error", "message" => $e->getMessage()]);
            }
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
            $check = SuratKeluar::where('id_surat_keluar',$id)->first();
            if($check->status !== 0) {
                return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
            } else {
                $data = SuratKeluar::where('id_surat_keluar',$id)->delete();

                return response()->json(["status" => "success", "message" => "Berhasil Hapus Data"]);
            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function checksuratkeluar($id)
    {
        try {
            $data = SuratKeluar::where('id_surat_keluar',$id)->first();
            if($data->status !== 0) {
                return 1;
            }else if($data->file_surat_keluar == null){
                return 2; 
            }else {
                return 0;
            }
        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function cetakpdfsk($id) {
        $suratkeluar = SuratKeluar::where('id_surat_keluar',$id)->first();
        $disposisi = Disposisi::select('disposisi.*','karyawan.nama_karyawan')
        ->leftJoin('karyawan','disposisi.diteruskan_kepada','karyawan.nik')
        ->where('disposisi.id_surat_keluar',$id)->orderBy('disposisi.created_at','desc')
        ->first();

        // return $disposisi;

        // $pdf = PDF::loadview('pdfsuratmasuk');
        $pdf = PDF::loadview('pdfsuratkeluar',[
            'suratkeluar'=>$suratkeluar,
            'disposisi'=>$disposisi,
        ]);
	    return $pdf->stream();
    }
}
