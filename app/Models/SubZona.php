<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubZona extends Model
{
    use HasFactory;
    protected $table = 'subzona';

    protected $fillable = ['zona_id', 'nama_subzona', 'foto', 'camera_id'];

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    public function slots()
    {
    return $this->hasMany(Slot::class, 'subzona_id');
    }
}
