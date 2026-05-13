<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dossier;
use App\Models\User;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_path',
        'dossier_id',
        'user_id'
    ];

    // 📁 كل document تابع لدossier
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    // 👤 كل document تابع لمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}