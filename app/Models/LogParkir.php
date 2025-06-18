<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogParkir extends Model
{
    protected $table = 'log_parkir';
    protected $fillable = [
        'zona_id',
        'subzona_id',
        'nomor_slot',
        'waktu_mulai',
        'waktu_selesai',
        'durasi',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function subzona()
    {
        return $this->belongsTo(SubZona::class);
    }
}
