<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newsletter extends Model
{
    use HasFactory;

    public function cycle()
    {
        return $this->belongsTo(Salecycle::class, 'salecycle_id');
    }
}
