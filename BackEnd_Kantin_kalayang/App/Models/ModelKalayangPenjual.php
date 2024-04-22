<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKalayangPenjual extends Model
{
    use HasFactory;
    protected $table ='tb_penjual';
    protected $primaryKey ='id_penjual ';
    protected $fillable = ['id_menu','id_transaksi','nomor_telepon','nama_toko', 'kata_sandi','token','created_at','updated_at'];
}
