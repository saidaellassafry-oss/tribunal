<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class DemandeController extends Controller
{
    // 📄 Afficher toutes les demandes
    public function index(Request $request)
    {
        $query = Demande::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $demandes = $query->latest()->get();

        return view('demandes.index', compact('demandes'));
    }

    // ➕ Ajouter demande
    public function store(Request $request)
    {
        Demande::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'cin' => $request->cin,
            'address' => $request->address,
            'city' => $request->city,
            'priority' => $request->priority,
            'status' => 'en_attente',
        ]);

        return redirect('/demandes');
    }

    // 👁️ Edit page (modifier)
    public function edit($id)
    {
        $demande = Demande::findOrFail($id);
        return view('demandes.edit', compact('demande'));
    }

    // ✏️ Update demande
    public function update(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);

        $demande->update([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'cin' => $request->cin,
            'address' => $request->address,
            'city' => $request->city,
            'priority' => $request->priority,
        ]);

        return redirect('/demandes');
    }

    // 🗑️ Delete demande
    public function destroy($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return redirect('/demandes');
    }

    // ✔️ Accept
    public function accept($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->status = 'accepté';
        $demande->save();

        return redirect('/demandes');
    }

    // ✖ Reject
    public function reject($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->status = 'refusé';
        $demande->save();

        return redirect('/demandes');
    }
}