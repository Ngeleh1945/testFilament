<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table = 'produk';
    public $timestamps = false;

    protected $fillable = [
        'kd_material',
        'kd_produk',
        'deskripsi',
        'speed',
        'isi_dus'
    ];

    protected $primaryKey = 'kd_material';
}
