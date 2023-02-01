<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alert extends Model
{
    use HasFactory;

    protected $fillable = ['checked'];

    public function profile()
    {
        return $this->belongsTo(nfcprofile::class, 'profile_id');
    }
}
