<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;

    protected $with = ['profile', 'user', 'contact', 'product'];

    public function profile()
    {
        return $this->belongsTo(nfcprofile::class, 'profile_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contact()
    {
        return $this->belongsTo(contact::class, 'contact_id');
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
