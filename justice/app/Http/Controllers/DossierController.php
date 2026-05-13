<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;

class DossierController extends Controller
{
    public function index()
    {
        $dossiers = Dossier::all();
        return view('dossiers.index', compact('dossiers'));
    }

    public function archives()
    {
        $dossiers = Dossier::where('status', 'terminé')->get();
        return view('archives', compact('dossiers'));
    }

    public function store(Request $request)
    {
        Dossier::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'en cours',
            'client' => $request->client,
            'date_ouverture' => $request->date_ouverture,
            'date_cloture' => $request->date_cloture,
        ]);

        return redirect('/dossiers');
    }

    public function destroy($id)
    {
        Dossier::findOrFail($id)->delete();
        return redirect('/dossiers');
    }

    public function edit($id)
    {
        $dossier = Dossier::findOrFail($id);
        return view('dossiers.edit', compact('dossier'));
    }

    public function update(Request $request, $id)
    {
        $dossier = Dossier::findOrFail($id);

        $dossier->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'client' => $request->client,
            'date_ouverture' => $request->date_ouverture,
            'date_cloture' => $request->date_cloture,
        ]);

        return redirect('/dossiers');
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $dossiers = Dossier::where('title', 'like', "%$q%")
            ->orWhere('client', 'like', "%$q%")
            ->orWhere('status', 'like', "%$q%")
            ->get();

        return view('dossiers.index', compact('dossiers'));
    }
}