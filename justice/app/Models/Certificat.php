<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Demande;

class Certificat extends Model
{
    use HasFactory;

    protected $fillable = [
        'demande_id',
        'user_id',
        'type',
        'cert_number',
        'pdf_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}