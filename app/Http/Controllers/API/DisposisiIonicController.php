<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;

use App\Disposisi;
use App\Karyawan;
use App\SuratMasuk;
use App\SuratKeluar;

class DisposisiIonicController extends Controller
{

    public function index(Request $request)
    {
        try {
            if($request->module == 'suratmasuk'){

                $data = Disposisi::where('nik',$request->nik)->with(['suratmasuk'])->whereNotNull('id_surat_masuk')->get();

            } else if($request->module == 'suratkeluar') {

                $data = Disposisi::where('nik',$request->nik)->with(['suratkeluar'])->whereNotNull('id_surat_keluar')->get();
            }   

            return response()->json(['status' => "show", "message" => "Menampilkan Data" , 'data' => $data]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Disposisi::findOrFail($id);

            if($request->module == 'suratmasuk'){
                if($data->status !== 1) {
                    return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
                } else {
                    if($request->data['aksi'] == 'approval') {
                        // return 'approval';
                        if($data->dengan_hormat_harap == null || $data->catatan_tindak_lanjut == null) {
                            $data->dengan_hormat_harap = $request->data['dengan_hormat_harap'];
                            $data->catatan_tindak_lanjut = $request->data['catatan_tindak_lanjut'];
                        }
                        $data->aksi =  $request->data['aksi'];
                        $data->status = $request->data['approval'];
                        $data->save();

                        $suratmasuk = SuratMasuk::where('id_surat_masuk',$data->id_surat_masuk)->first();
                        $suratmasuk->status = $request->data['approval'];
                        $suratmasuk->save();

                    } else if($request->data['aksi'] == 'teruskan') {
                        // return 'teruskan';
                        if($data->nik !== (int)$request->data['teruskan']) {
                            if($data->dengan_hormat_harap == null || $data->catatan_tindak_lanjut == null) {
                                $data->dengan_hormat_harap = $request->data['dengan_hormat_harap'];
                                $data->catatan_tindak_lanjut = $request->data['catatan_tindak_lanjut'];
                            }
                            $data->aksi = $request->data['aksi'];
                            $data->diteruskan_kepada = $request->data['teruskan'];
                            $data->status = 4;
                            $data->save();
                            
                            $newdisposisi = Disposisi::create([
                                'id_surat_masuk' => $data->id_surat_masuk,
                                'nik' => $request->data['teruskan'],
                                'no_agenda' => $data->no_agenda,
                                'tgl_disposisi' => $data->tgl_disposisi,
                                // 'diteruskan_kepada' => $request->data['teruskan'],
                                'dengan_hormat_harap' => $data->dengan_hormat_harap,
                                'catatan_tindak_lanjut' => $data->catatan_tindak_lanjut,
                                'status' => 1,
                                'file_disposisi' => $data->file_disposisi,
                            ]);
                        } else {
                            
                            return response()->json(["status" => "error", "message" => 'Tidak Bisa Diteruskan dengan orang yang sama']);
    
                        }
                    }
                    // $data->update($request->data);
                    return response()->json(['status' => "success", "message" => "Berhasil Ubah Data"]);
                }
            } else if($request->module == 'suratkeluar') {
                if($data->status !== 1) {
                    return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
                } else {
                    if($request->data['aksi'] == 'approval') {
                        // return 'approval';
                        if($data->dengan_hormat_harap == null || $data->catatan_tindak_lanjut == null) {
                            $data->dengan_hormat_harap = $request->data['dengan_hormat_harap'];
                            $data->catatan_tindak_lanjut = $request->data['catatan_tindak_lanjut'];
                        }
                        $data->aksi =  $request->data['aksi'];
                        $data->status = $request->data['approval'];
                        $data->save();

                        $suratkeluar = SuratKeluar::where('id_surat_keluar',$data->id_surat_keluar)->first();
                        $suratkeluar->status = $request->data['approval'];
                        $suratkeluar->save();

                    } else if($request->data['aksi'] == 'teruskan') {
                        // return 'teruskan';
                        if($data->nik !== (int)$request->data['teruskan']) {
                            if($data->dengan_hormat_harap == null || $data->catatan_tindak_lanjut == null) {
                                $data->dengan_hormat_harap = $request->data['dengan_hormat_harap'];
                                $data->catatan_tindak_lanjut = $request->data['catatan_tindak_lanjut'];
                            }
                            $data->aksi = $request->data['aksi'];
                            $data->diteruskan_kepada = $request->data['teruskan'];
                            $data->status = 4;
                            $data->save();
                            
                            $newdisposisi = Disposisi::create([
                                'id_surat_keluar' => $data->id_surat_keluar,
                                'nik' => $request->data['teruskan'],
                                'no_agenda' => $data->no_agenda,
                                'tgl_disposisi' => $data->tgl_disposisi,
                                // 'diteruskan_kepada' => $request->data['teruskan'],
                                'dengan_hormat_harap' => $data->dengan_hormat_harap,
                                'catatan_tindak_lanjut' => $data->catatan_tindak_lanjut,
                                'status' => 1,
                                'file_disposisi' => $data->file_disposisi,
                            ]);
                        } else {
                            
                            return response()->json(["status" => "error", "message" => 'Tidak Bisa Diteruskan dengan orang yang sama']);
    
                        }
                    }
                    
                    return response()->json(['status' => "success", "message" => "Berhasil Ubah Data"]);
                }
            }
            
            
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
        //
    }

    public function showsuratmasuk()
    {
        $karyawan = Karyawan::select('id_karyawan','nama_karyawan','nik')->pluck('nik','nama_karyawan');

        return view('pages/disposisi/dsuratmasuk',[
            "karyawan" => $karyawan
        ]);
    }

    public function showsuratkeluar()
    {
        $karyawan = Karyawan::select('id_karyawan','nama_karyawan','nik')->pluck('nik','nama_karyawan');

        return view('pages/disposisi/dsuratkeluar',[
            "karyawan" => $karyawan
        ]);
    }

    public function aksi(Request $request) {
        try {
            $id = $request->getid;
            // return $request->all();
            if($request->module == 'suratmasuk') {
                if($request->aksi == 'approval') {
                    $disposisi = Disposisi::findOrFail($id);
                    $disposisi->status = $request->approval;
                    $disposisi->save();

                    $suratmasuk = SuratMasuk::where('id_surat_masuk',$disposisi->id_surat_masuk)->first();
                    $suratmasuk->status = $request->approval;
                    $suratmasuk->save();
                } else if($request->aksi == 'teruskan') {
                    $disposisi = Disposisi::findOrFail($id);
                    if($disposisi->nik !== (int)$request->teruskan) {

                        $disposisi->status = 4;
                        $disposisi->save();

                        
                        $newdisposisi = Disposisi::create([
                            'id_surat_masuk' => $disposisi->id_surat_masuk,
                            'nik' => $request->teruskan,
                            'no_agenda' => $disposisi->no_agenda,
                            'tgl_disposisi' => $disposisi->tgl_disposisi,
                            'diteruskan_kepada' => $request->teruskan,
                            // 'dengan_hormat_harap' => $disposisi->dengan_hormat_harap,
                            // 'catatan_tindak_lanjut' => $disposisi->catatan_tindak_lanjut,
                            'status' => 1,
                            'file_disposisi' => $disposisi->file_disposisi,
                        ]);
                    } else {
                        
                        return response()->json(["status" => "error", "message" => 'Tidak Bisa Diteruskan dengan orang yang sama']);

                    }


                }
            } else if($request->module == 'suratkeluar') {
                if($request->aksi == 'approval') {
                    $disposisi = Disposisi::findOrFail($id);
                    $disposisi->status = $request->approval;
                    $disposisi->save();

                    $suratkeluar = SuratKeluar::where('id_surat_keluar',$disposisi->id_surat_keluar)->first();
                    $suratkeluar->status = $request->approval;
                    $suratkeluar->save();
                } else if($request->aksi == 'teruskan') {
                    $disposisi = Disposisi::findOrFail($id);
                    if($disposisi->nik !== (int)$request->teruskan) {

                        $disposisi->status = 4;
                        $disposisi->save();
                        
                        $newdisposisi = Disposisi::create([
                            'id_surat_keluar' => $disposisi->id_surat_keluar,
                            'nik' => $request->teruskan,
                            'no_agenda' => $disposisi->no_agenda,
                            'tgl_disposisi' => $disposisi->tgl_disposisi,
                            'diteruskan_kepada' => $request->teruskan,
                            // 'dengan_hormat_harap' => $disposisi->dengan_hormat_harap,
                            // 'catatan_tindak_lanjut' => $disposisi->catatan_tindak_lanjut,
                            'status' => 1,
                            'file_disposisi' => $disposisi->file_disposisi,
                        ]);
                    } else {
                        
                        return response()->json(["status" => "error", "message" => 'Tidak Bisa Diteruskan dengan orang yang sama']);

                    }


                }
            }

            return response()->json(['status' => "success", "message" => "Berhasil Ubah Data"]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function checkdisposisi($id)
    {
        try {
            $data = Disposisi::where('id_disposisi',$id)->first();
            if($data->status !== 1) {
                return 1;
            } else {
                return 0;
            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
