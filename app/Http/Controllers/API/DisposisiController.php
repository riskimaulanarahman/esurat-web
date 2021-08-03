<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;
use App\Http\Controllers\GenerateMailController;


use App\Disposisi;
use App\Karyawan;
use App\SuratMasuk;
use App\SuratKeluar;
use App\User;



class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request->all();
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

    public function senddisposisi(Request $request)
    {
        try {

            if($request->module == "suratmasuk") {

                Disposisi::create([
                    "id_surat_masuk" => $request->getid,
                    "nik" => $request->nik,
                    "no_agenda" => $request->no_agenda,
                    "status" => 1,
                    "file_disposisi" => $request->file_disposisi,
                    "tgl_disposisi" => Carbon::today()->format('Y-m-d')
                ]);
                $getsm = SuratMasuk::where('id_surat_masuk',$request->getid)->first();
                $getsm->update([
                    "status" => 1
                ]);
                
            } else if($request->module == "suratkeluar") {
                Disposisi::create([
                    "id_surat_keluar" => $request->getid,
                    "nik" => $request->nik,
                    "no_agenda" => $request->no_agenda,
                    "status" => 1,
                    "file_disposisi" => $request->file_disposisi,
                    "tgl_disposisi" => Carbon::today()->format('Y-m-d')
                ]);   

                $getsk = SuratKeluar::where('id_surat_keluar',$request->getid)->first();
                $getsk->update([
                    "status" => 1
                ]);
            }

            $user = User::where('nik',$request->nik)->first();
            $karyawan = Karyawan::where('nik',$request->nik)->first();

            $module = "disposisi ".$request->module;
            $id_users = $request->idusers;
            $email = $user->email;
            $nama = $karyawan->nama_karyawan;
            $text = 'ada Disposisi menunggu persetujuan anda, silahkan cek aplikasi E-Surat';

            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);

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
            $data = Disposisi::findOrFail($id);

            if($request->module == 'suratmasuk'){
                if($data->status !== 1) {
                    return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
                } else {
                    if($data->dengan_hormat_harap == null && $data->catatan_tindak_lanjut == null) {
                        $data->dengan_hormat_harap = $request->data['dengan_hormat_harap'];
                        $data->catatan_tindak_lanjut = $request->data['catatan_tindak_lanjut'];
                        $data->save();
                        return response()->json(['status' => "success", "message" => "Berhasil Ubah Data"]);
                    } else {
                        return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
                    }
                }
            } else if($request->module == 'suratkeluar') {
                if($data->status !== 1) {
                    return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
                } else {
                    if($data->dengan_hormat_harap == null && $data->catatan_tindak_lanjut == null) {
                        $data->dengan_hormat_harap = $request->data['dengan_hormat_harap'];
                        $data->catatan_tindak_lanjut = $request->data['catatan_tindak_lanjut'];
                        $data->save();
                        return response()->json(['status' => "success", "message" => "Berhasil Ubah Data"]);
                    } else {
                        return response()->json(["status" => "error", "message" => "aksi tidak di izinkan"]);
                    }
                }
            }
            
            
        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
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

            if($request->approval == 2) {
                $stsapp = "approved";
            } else if($request->approval == 3) {
                $stsapp = "rejected";
            } 
            // else if($request->approval == 4) {
            //     $stsapp = "diteruskan";
            // }
            //email
            if($request->module == 'suratmasuk') {

                if($request->aksi == 'approval') {
                    
                    $user = User::where('nik',0)->first();
                    // $karyawan = Karyawan::where('nik',0)->first();
                    
                    $module = $stsapp." - ".$request->module;
                    $id_users = $request->idusers;
                    $email = $user->email;
                    $nama = $user->username;
                    $text = 'status disposisi dengan nomor surat '.$suratmasuk->no_surat.' telah '.$stsapp.' , silahkan cek aplikasi E-Surat';
                    
                } else if($request->aksi == 'teruskan') {
                    $user = User::where('nik',$request->teruskan)->first();
                    $karyawan = Karyawan::where('nik',$request->teruskan)->first();
                    
                    $module = $request->module." - diteruskan";
                    $id_users = $request->idusers;
                    $email = $user->email;
                    $nama = $karyawan->nama_karyawan;
                    $text = 'ada Disposisi menunggu persetujuan anda, silahkan cek aplikasi E-Surat';
                }
            } else if($request->module == 'suratkeluar') {
                if($request->aksi == 'approval') {
                    
                    $user = User::where('nik',0)->first();
                    // $karyawan = Karyawan::where('nik',0)->first();
                    
                    $module = $stsapp." - ".$request->module;
                    $id_users = $request->idusers;
                    $email = $user->email;
                    $nama = $user->username;
                    $text = 'status disposisi dengan nomor surat '.$suratkeluar->no_surat.' telah '.$stsapp.' , silahkan cek aplikasi E-Surat';
                    
                } else if($request->aksi == 'teruskan') {
                    $user = User::where('nik',$request->teruskan)->first();
                    $karyawan = Karyawan::where('nik',$request->teruskan)->first();
                    
                    $module = $request->module." - diteruskan";
                    $id_users = $request->idusers;
                    $email = $user->email;
                    $nama = $karyawan->nama_karyawan;
                    $text = 'ada Disposisi menunggu persetujuan anda, silahkan cek aplikasi E-Surat';
                }
            }
                
            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);

            return response()->json(['status' => "success", "message" => "Berhasil Ubah Data"]);

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

    public function getdetail(Request $request)
    {
        try {
            if($request->module == 'suratmasuk') {
                $data = Disposisi::select('disposisi.*','karyawan.nama_karyawan')
                ->whereNotNull('disposisi.id_surat_masuk')
                ->leftJoin('karyawan','karyawan.nik','disposisi.nik')
                ->get();
            }else if($request->module == 'suratkeluar') {
                $data = Disposisi::select('disposisi.*','karyawan.nama_karyawan')
                ->whereNotNull('disposisi.id_surat_keluar')
                ->leftJoin('karyawan','karyawan.nik','disposisi.nik')
                ->get();
            }
            
            return response()->json($data);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

}
