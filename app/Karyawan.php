<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $guarded = ['id_karyawan'];

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan','id_jabatan');
    }
}
