<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    protected $table = 'zona';

    protected $fillable = ['nama_zona', 'keterangan', 'fotozona'];

    public function subzonas()
    {
        return $this->hasMany(SubZona::class, 'zona_id');
    }


    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'zona_id');
    }

    public function scopeTersedia($query)
    {
        return $query->where('keterangan', 'tersedia');
    }

    public function scopeTerisi($query)
    {
        return $query->where('keterangan', 'terisi');
    }

    public function scopePerbaikan($query)
    {
        return $query->where('keterangan', 'perbaikan');
    }

}
