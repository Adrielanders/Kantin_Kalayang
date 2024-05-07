<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKalayangPenjual extends Model
{
    use HasFactory;
    protected $table ='tb_penjual';
    protected $primaryKey ='id_penjual';
    protected $fillable = ['id_menu','id_transaksi','nama_pemilik','nomor_telepon','nama_toko','nomor_toko','email','kata_sandi','status_acc','created_at','updated_at'];
}
