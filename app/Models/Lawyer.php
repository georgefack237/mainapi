<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'image',
        'address',
        'phone',
        'mail',
        'matricule',
        'matricule_key',
        'matricule_key_hash'
    ];
}
