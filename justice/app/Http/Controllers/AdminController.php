<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Demande;
use App\Models\Audience;
use App\Models\User;

class AdminController extends Controller
{
    public function statistiques()
    {
        return view('admin.statistiques', [
            'dossiers_total' => Dossier::count(),
            'dossiers_termine' => Dossier::where('status','termine')->count(),
            'dossiers_en_cours' => Dossier::where('status','en_cours')->count(),
            'dossiers_attente' => Dossier::where('status','attente')->count(),

            'demandes_total' => Demande::count(),
            'audiences_total' => Audience::count(),
            'users_total' => User::count(),
        ]);
    }
}