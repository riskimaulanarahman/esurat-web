<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogMail extends Model
{
    use HasFactory;

    protected $table = "log_sendmail";

    protected $guarded = ['id_sendmail'];

    protected $primaryKey = 'id_sendmail';
}
