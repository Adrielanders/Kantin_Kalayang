<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKalayangMenu extends Model
{
    use HasFactory;
    protected $table ='tb_menu';
    protected $primaryKey ='id_menu';
    protected $fillable = ['jenis','nama_menu', 'harga_menu','ekstra', 'status_menu','desc_menu', 'created_at', 'updated_at'];
}
