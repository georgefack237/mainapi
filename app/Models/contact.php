<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';

    protected $fillable = ['user_id', 'profile_id', 'name', 'title', 'phone', 'is_client', 'converted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nfcprofile()
    {
        return $this->belongsTo(nfcprofile::class, 'profile_id');
    }

    public function notes()
    {
        return $this->hasMany(agent_note::class);
    }

    public function purchases()
    {
        return $this->hasMany(purchase::class);
    }

    public function appointments()
    {
        return $this->hasMany(appointment::class);
    }

    public function lastNote()
    {
        return $this->hasOne(agent_note::class)->latest();
    }
}
