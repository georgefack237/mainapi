<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'country', 'city', 'address', 'create_limit'
        ];
        
    // protected $with = 'purchases';

    public function sales()
    {
        return $this->hasMany(purchase::class, 'product_id');
    }
}
