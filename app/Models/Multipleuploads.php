<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multipleuploads extends Model
{
    // >>>> TAMBAHAN: pastikan nama tabel cocok dengan migration
    protected $table = 'multipleuploads';
    protected $primaryKey = 'id';
    protected $fillable = ['pelanggan_id','filename','filepath','filesize','created_at','updated_at'];

    // >>>> TAMBAHAN: relasi balik ke pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }
}
