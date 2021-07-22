<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'tbl_absensi';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo('App\User','nip','nip');
    }

}
