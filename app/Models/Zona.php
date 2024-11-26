<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    protected $table = 'zona';

    protected $fillable = ['nama_zona', 'keterangan'];

    public function subzonas()
    {
        return $this->hasMany(Subzona::class, 'zona_id');
    }

}
