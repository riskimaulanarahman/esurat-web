<?php

namespace App\Http\Controllers\masteruser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Karyawan;


class LoginUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = User::all();

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

        try {
            $request->validate([
                'username' => 'required | unique:users',
                'email' => 'required | unique:users',
                'nik' => 'required | unique:users',
            ]);
            
            $user = User::create([
                'nik' => $request->nik,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($request->password),
            ]);
            
            $karyawan = Karyawan::create([
                'nik' => $request->nik,
                'id_jabatan' => $request->jabatan,
                'nama_karyawan' => $request->nama_karyawan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);

            $karyawan->save();
            // $user->save();

            return response()->json(["status" => "success", "message" => "Berhasil Menambahkan Data"]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function show()
    {
        return view('pages/masteruser/masteruser');
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
    
            $user = User::findOrFail($id);
            $user->update([
                'nik' => $request->nik,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            if(!empty($request->password)) {
                $user->password = bcrypt($request->password);
                $user->save();
            }

            $karyawan = Karyawan::where('id_karyawan',$user->id)->first();

            $karyawan = Karyawan::update([
                'id_jabatan' => $request->jabatan,
                'nama_karyawan' => $request->nama_karyawan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);

            // $karyawan->save();
            
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
            $data = User::findOrFail($id);
            if($data->role !== 'admin') {
                $data->delete();
                return response()->json(["status" => "success", "message" => "Berhasil Hapus Data"]);
            } else {
                return response()->json(["status" => "error", "message" => "Tidak bisa hapus Admin"]);
            }


        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
