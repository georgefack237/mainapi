<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcode extends Model
{
    use HasFactory;
    protected $table = 'qrcodes';
    protected $fillable = [
        'firstname',
        'lastname',
        'companyname',
        'title',
        'address',
        'phone1',
        'phone2',
        'email',
        'email2',
        'website'
    ];
}
