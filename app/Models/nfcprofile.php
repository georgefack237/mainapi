<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class nfcprofile extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'nfcprofiles';
    protected $fillable = [
        'slug',
        'user_id',
        'firstname',
        'lastname',
        'image',
        'companyname',
        'title',
        'address',
        'phone1',
        'email',
        'password',
        'website',
        'facebook',
        'twitter',
        'linkedin'
    ];

    protected $with = ['contacts', 'appointments'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pageviews()
    {
        return $this->hasMany(pageviews::class, 'page_id');
    }

    public function contacts()
    {
        return $this->hasMany(contact::class, 'profile_id');
    }

    public function sales()
    {
        return $this->hasMany(purchase::class, 'profile_id');
    }

    public function appointments()
    {
        return $this->hasMany(appointment::class, 'profile_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
