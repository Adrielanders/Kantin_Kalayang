<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKalayangTransaksi extends Model
{
    use HasFactory;
    protected $table ='tb_transaksi';
    protected $primaryKey ='id_transaksi ';
    protected $fillable = ['id_menu', 'id_order','id_penjual','tanggal_pemesanan', 'nomor_meja','status_pesanan', 'catatan_pemesan', 'ekstra_menu','pesanan','created_at','updated_at'];
}
