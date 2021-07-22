<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi';
    protected $primaryKey = 'id_disposisi';
    protected $guarded = ['id_disposisi'];

    public function suratmasuk()
    {
        return $this->belongsTo('App\SuratMasuk','id_surat_masuk');
    }

    public function suratkeluar()
    {
        return $this->belongsTo('App\SuratKeluar','id_surat_keluar');
    }
}
