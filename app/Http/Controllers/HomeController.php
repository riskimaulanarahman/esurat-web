<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\SuratMasuk;
use App\SuratKeluar;
use App\Disposisi;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //surat masuk dashboard
        $allsm = Suratmasuk::select('*')->count();
        $todaysm = SuratMasuk::whereDate('tgl_diterima',Carbon::today())->count();
        $weeksm = SuratMasuk::where('tgl_diterima', '>', Carbon::now()->startOfWeek())
            ->where('tgl_diterima', '<', Carbon::now()->endOfWeek())
            ->count();
        $monthsm = SuratMasuk::whereMonth('tgl_diterima',Carbon::now())->count();

        //surat keluar dashboard
        $allsk = SuratKeluar::select('*')->count();
        $todaysk = SuratKeluar::whereDate('tgl_dibuat',Carbon::today())->count();
        $weeksk = SuratKeluar::where('tgl_dibuat', '>', Carbon::now()->startOfWeek())
            ->where('tgl_dibuat', '<', Carbon::now()->endOfWeek())
            ->count();
        $monthsk = SuratKeluar::whereMonth('tgl_dibuat',Carbon::now())->count();

        //disposisi
        $user = Auth::user();
        $alldisposisi = Disposisi::select('*')->where('nik',$user->nik)->count();
        $nosm = Disposisi::select('*')
        ->whereNotNull('id_surat_masuk')
        ->where('nik',$user->nik)
        ->where('status',1)
        ->count();
        $nosk = Disposisi::select('*')
        ->whereNotNull('id_surat_keluar')
        ->where('nik',$user->nik)
        ->where('status',1)
        ->count();


        if(Auth::user()->role == 'admin') {
            
            return view('dashboard-admin')->with(compact(
                'todaysm', 'weeksm', 'monthsm','allsm',
                'todaysk', 'weeksk', 'monthsk','allsk',
            ));

        } elseif(Auth::user()->role == 'user') {

            return view('dashboard-user')->with(compact(
                'nosm', 'nosk','alldisposisi',
            ));

        }
    }
}
