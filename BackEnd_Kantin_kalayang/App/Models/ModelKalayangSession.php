<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKalayangSession extends Model
{
    use HasFactory;
    protected $table ='tb_sessions';
    protected $primaryKey ='id_menu';
    protected $fillable = ['id_penjual','login', 'loguot','created_at', 'updated_at','token','token_expires_at','remember_token'];
}
