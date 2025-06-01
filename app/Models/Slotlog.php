<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotLog extends Model
{
    use HasFactory;
    protected $table = 'slot_logs';

    protected $fillable = ['slot_id', 'status', 'waktu'];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}

