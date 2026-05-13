<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dossier;

class Audience extends Model
{
    protected $fillable = [
        'dossier_id',
        'defenseur',
        'accuse',
        'titre',
        'tribunal',
        'salle',
        'date_audience',
        'heure',
        'juge',
        'status',
        'notes'
    ];

    // 📁 relation مع dossier فقط
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}