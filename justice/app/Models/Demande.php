<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certificat;
use App\Models\User;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'dossier_number',
        'title',
        'type',
        'description',
        'status',
        'full_name',
        'phone',
        'cin',
        'address',
        'city',
        'priority',
        'user_id',
        'email'
    ];

    // 👤 user owner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 📄 one certificat
    public function certificat()
    {
        return $this->hasOne(Certificat::class);
    }
}