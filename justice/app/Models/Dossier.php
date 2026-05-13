<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'numero_dossier',
        'type_affaire',
        'status',
        'client',
        'date_ouverture',
        'date_cloture'
    ];
}