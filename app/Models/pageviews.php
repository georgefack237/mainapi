<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pageviews extends Model
{
    use HasFactory;
    protected $table = 'pageviews';

    public function nfcprofile()
    {
        return $this->belongsTo(nfcprofile::class, 'page_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
