<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agent_note extends Model
{
    use HasFactory;

    protected $filable = ['profile_id','contact_id', 'title', 'body', 'date'];

    public function nfcprofile()
    {
        return $this->belongsTo(nfcprofile::class, 'profile_id');
    }
}
