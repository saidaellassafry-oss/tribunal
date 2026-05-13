<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audience;
use App\Models\Dossier;

class AudienceController extends Controller
{
    // 📄 LIST + SEARCH
    public function index(Request $request)
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        $query = Audience::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%$search%")
                  ->orWhere('tribunal', 'like', "%$search%")
                  ->orWhere('juge', 'like', "%$search%")
                  ->orWhere('defenseur', 'like', "%$search%")
                  ->orWhere('accuse', 'like', "%$search%");
            });
        }

        $audiences = $query->latest()->get();

        return view('audiences.index', compact('audiences', 'user'));
    }

    // ➕ CREATE FORM
    public function create()
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        return view('audiences.create', [
            'dossiers' => Dossier::all(),
            'user'     => $user
        ]);
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        $data = $request->validate([
            'titre'         => 'required|string',
            'tribunal'      => 'nullable|string',
            'salle'         => 'nullable|string',
            'date_audience' => 'nullable|date',
            'heure'         => 'nullable',
            'juge'          => 'nullable|string',
            'status'        => 'nullable|string',
            'notes'         => 'nullable|string',
            'dossier_id'    => 'nullable|exists:dossiers,id',
            'defenseur'     => 'nullable|string',
            'accuse'        => 'nullable|string',
        ]);

        Audience::create($data);

        return redirect('/audiences')->with('success', 'Audience ajoutée');
    }

    // ✏ EDIT FORM
    public function edit($id)
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        return view('audiences.edit', [
            'a'        => Audience::findOrFail($id),
            'dossiers' => Dossier::all(),
            'user'     => $user
        ]);
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        $data = $request->validate([
            'titre'         => 'required|string',
            'tribunal'      => 'nullable|string',
            'salle'         => 'nullable|string',
            'date_audience' => 'nullable|date',
            'heure'         => 'nullable',
            'juge'          => 'nullable|string',
            'status'        => 'nullable|string',
            'notes'         => 'nullable|string',
            'dossier_id'    => 'nullable|exists:dossiers,id',
            'defenseur'     => 'nullable|string',
            'accuse'        => 'nullable|string',
        ]);

        Audience::findOrFail($id)->update($data);

        return redirect('/audiences')->with('success', 'Audience modifiée');
    }

    // 🗑 DELETE
    public function destroy($id)
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        Audience::findOrFail($id)->delete();

        return back()->with('success', 'Audience supprimée');
    }

    // 👤 CITIZEN VIEW
    public function citizenIndex()
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        $audiences = Audience::latest()->get();

        return view('citizen.audiences', compact('audiences', 'user'));
    }

    // 🔍 SEARCH (CITIZEN)
    public function search(Request $request)
    {
        $user = session('user');
        if (!$user) return redirect('/login');

        $q = $request->q;

        $audiences = Audience::query()
            ->when($q, function ($query) use ($q) {
                $query->where('titre', 'like', "%$q%")
                      ->orWhere('tribunal', 'like', "%$q%")
                      ->orWhere('date_audience', 'like', "%$q%")
                      ->orWhere('juge', 'like', "%$q%")
                      ->orWhere('defenseur', 'like', "%$q%")
                      ->orWhere('accuse', 'like', "%$q%");
            })
            ->get();

        return view('citizen.audiences', compact('audiences', 'user'));
    }
}