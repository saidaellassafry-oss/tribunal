<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\User;
use App\Models\Dossier;
use App\Models\Demande;

/* =========================
   🏠 HOME
========================= */
Route::view('/', 'welcome');

/* =========================
   🔐 AUTH PAGES
========================= */
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

/* =========================
   🧠 AUTH HELPER
========================= */
function authUser()
{
    return session('user');
}

/* =========================
   📝 REGISTER
========================= */
Route::post('/register', function (Request $request) {

    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:4'
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => 'citizen'
    ]);

    return redirect('/login');
});

/* =========================
   🔐 LOGIN
========================= */
Route::post('/login', function (Request $request) {

    $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    $role = null;

    if ($request->email === 'admin@tribunal.ma' && $request->password === '1234') {
        $role = 'admin';
    }
    elseif ($request->email === 'employee@tribunal.ma' && $request->password === '1234') {
        $role = 'employee';
    }
    else {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $role = $user->role;
        }
    }

    if (!$role) {
        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    session()->regenerate();

    session([
        'user' => [
            'email' => $request->email,
            'role'  => $role
        ]
    ]);

    return match ($role) {
        'admin'    => redirect('/dashboard'),
        'employee' => redirect('/employee/dashboard'),
        'citizen'  => redirect('/citizen/dashboard'),
    };
});

/* =========================
   🚪 LOGOUT
========================= */
Route::post('/logout', function () {
    session()->flush();
    return redirect('/login');
});

/* =========================
   👑 ADMIN DASHBOARD
========================= */
Route::get('/dashboard', function () {

    $user = authUser();
    if (!$user || $user['role'] !== 'admin') return redirect('/login');

    return view('admin.dashboard', [
        'user'    => $user,
        'total'   => Dossier::count(),
        'enCours' => Dossier::where('status','en_cours')->count(),
        'termine' => Dossier::where('status','termine')->count(),
        'attente' => Dossier::where('status','attente')->count(),
        'latest'  => Dossier::latest()->take(5)->get()
    ]);
});

/* =========================
   🧑 EMPLOYEE DASHBOARD
========================= */
Route::get('/employee/dashboard', function () {

    $user = authUser();
    if (!$user || $user['role'] !== 'employee') return redirect('/login');

    return view('employee.dashboard', compact('user'));
});

/* =========================
   👤 CITIZEN DASHBOARD
========================= */
Route::get('/citizen/dashboard', function () {

    $user = authUser();
    if (!$user || $user['role'] !== 'citizen') return redirect('/login');

    return view('citizen.dashboard', compact('user'));
});

/* =========================
   📁 DOSSIERS LIST
========================= */
Route::get('/dossiers', function (Request $request) {

    $user = session('user');

    $query = Dossier::query();

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title','like',"%$search%")
              ->orWhere('client','like',"%$search%")
              ->orWhere('numero_dossier','like',"%$search%")
              ->orWhere('type_affaire','like',"%$search%")
              ->orWhere('status','like',"%$search%");
        });
    }

    return view('dossiers', [
        'dossiers' => $query->latest()->get(),
        'user' => $user,
        'canEdit' => $user && in_array($user['role'], ['admin','employee'])
    ]);
});

/* =========================
   ➕ CREATE PAGE
========================= */
Route::get('/dossiers/create', function () {
    return view('dossiers.create');
});

/* =========================
   ➕ STORE
========================= */
Route::post('/dossiers', function (Request $request) {

    Dossier::create($request->only([
        'title','description','numero_dossier','type_affaire',
        'status','client','date_ouverture','date_cloture'
    ]));

    return redirect('/dossiers');
});

/* =========================
   ✏ EDIT
========================= */
Route::get('/dossiers/{id}/edit', function ($id) {

    return view('dossiers.edit', [
        'dossier' => Dossier::findOrFail($id)
    ]);
});

/* =========================
   ✏ UPDATE
========================= */
Route::put('/dossiers/{id}', function (Request $request, $id) {

    $dossier = Dossier::findOrFail($id);

    $dossier->update($request->only([
        'title','description','numero_dossier','type_affaire',
        'status','client','date_ouverture','date_cloture'
    ]));

    return redirect('/dossiers');
});

/* =========================
   🗑 DELETE
========================= */
Route::delete('/dossiers/{id}', function ($id) {

    Dossier::findOrFail($id)->delete();

    return redirect('/dossiers');
});

/* =========================
   📄 LIST */
/* LIST */
/* LIST */
Route::get('/demandes', function (Request $request) {

    $user = authUser();

    if (!$user) {
        return redirect('/login');
    }

    // 👇 هنا كنبدأو query
    $query = Demande::query();

    // 🔍 SEARCH (ديرو هنا بالضبط)
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('type', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%")
              ->orWhere('full_name', 'like', "%$search%")
              ->orWhere('cin', 'like', "%$search%");
        });
    }

    // 👤 citizen filter (خليه كما هو)
    if ($user['role'] === 'citizen') {

        $citizen = User::where('email', $user['email'])->first();

        $query->where('user_id', $citizen->id);
    }

    // 🔥 final result
    $demandes = $query->latest()->get();

    return view('demandes', compact('demandes', 'user'));
});
/* CREATE */
Route::post('/demandes', function (Request $request) {

    $user = authUser();

    if (!$user || $user['role'] !== 'citizen') {
        return redirect('/login');
    }

    $citizen = App\Models\User::where('email', $user['email'])->first();

    if (!$citizen) {
        return back()->withErrors(['error' => 'User not found']);
    }

    App\Models\Demande::create([
        'title'       => $request->title,
        'type'        => $request->type,
        'description' => $request->description,
        'full_name'   => $request->full_name,
        'phone'       => $request->phone,
        'cin'         => $request->cin,
        'address'     => $request->address,
        'city'        => $request->city,
        'priority'    => $request->priority,
        'status'      => 'en_attente',
        'user_id'     => $citizen->id,   // ⭐ هنا الحل ديال المشكل
        'email'       => $citizen->email,
    ]);

    return back();
});

/* ACCEPT */
Route::post('/demandes/{id}/accept', function ($id) {

    $user = authUser();

    if (!$user || !in_array($user['role'], ['admin', 'employee'])) {
        return redirect('/login');
    }

    $demande = Demande::findOrFail($id);
    $demande->status = 'accepté';
    $demande->save();

    return back();
});

/* REJECT */
Route::post('/demandes/{id}/reject', function ($id) {

    $user = authUser();

    if (!$user || !in_array($user['role'], ['admin', 'employee'])) {
        return redirect('/login');
    }

    $demande = Demande::findOrFail($id);
    $demande->status = 'refusé';
    $demande->save();

    return back();
});
/* =========================
   🖨 PDF DEMANDE
========================= */
Route::get('/demandes/{id}/pdf', function ($id) {

    $demande = Demande::findOrFail($id);

    $pdf = Pdf::loadView('pdf.demande', compact('demande'))
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);

    return $pdf->download('demande-'.$demande->id.'.pdf');
});
use App\Models\Announcement;

/* =========================
   📢 ANNOUNCEMENTS PAGE
========================= */
Route::get('/annonces', function () {

    $user = session('user');

    if (!$user) {
        return redirect('/login');
    }

    return view('annonces.index', [
        'user' => $user,
        'annonces' => Announcement::latest()->get()
    ]);
});

/* =========================
   <?php

use Illuminate\Support\Facades\Route;
use App\Models\Announcement;
use Illuminate\Http\Request;

/* HOME */
Route::get('/', function () {
    return view('welcome');
});


/* =========================
   📢 ANNOUNCEMENTS (FIXED)
========================= */
Route::get('/annonces', function () {

    $user = authUser();
    if (!$user) return redirect('/login');

    return view('annonces.index', [
        'user' => $user,
        'annonces' => Announcement::latest()->get()
    ]);
});

/* CREATE */
Route::post('/annonces', function (Request $request) {

    Announcement::create([
        'title' => $request->title,
        'content' => $request->content,
        'type' => $request->type
    ]);

    return redirect('/annonces');
});

/* DELETE */
Route::get('/annonces/delete/{id}', function ($id) {

    Announcement::findOrFail($id)->delete();

    return redirect('/annonces');
});

/* EDIT */
Route::get('/annonces/edit/{id}', function ($id) {

    return view('annonces.edit', [
        'a' => Announcement::findOrFail($id)
    ]);
});

/* UPDATE */
Route::post('/annonces/update/{id}', function (Request $request, $id) {

    $a = Announcement::findOrFail($id);

    $a->update([
        'title' => $request->title,
        'content' => $request->content,
        'type' => $request->type
    ]);

    return redirect('/annonces');
});

/* SHOW */
Route::get('/annonces/{id}', function ($id) {

    $a = Announcement::findOrFail($id);

    return view('annonces.show', compact('a'));
});
use App\Models\Audience;

Route::get('/audiences', function () {
    $audiences = Audience::latest()->get();
    return view('audiences', compact('audiences'));
});



/* FORM */


/* 📄 PAGE CREATE */



Route::get('/audiences/create', function () {

    return view('audiences.create', [
        'dossiers' => Dossier::all(),
        'users' => User::all()
    ]);
});
/* 💾 STORE */
Route::post('/audiences/store', function (Request $request) {

    Audience::create([
    'titre' => $request->titre,
    'tribunal' => $request->tribunal,
    'salle' => $request->salle,
    'date_audience' => $request->date_audience,
    'heure' => $request->heure,
    'juge' => $request->juge,
    'status' => $request->status,
    'notes' => $request->notes,

    // 🔥 مهم بزاف
    'dossier_id' => $request->dossier_id,
    'defenseur_id' => $request->defenseur_id,
    'accuse_id' => $request->accuse_id,
]);
    return redirect('/audiences');
});


Route::get('/audiences', function () {

    $audiences = Audience::with(['dossier','defenseur','accuse'])
        ->latest()
        ->get();

    return view('audiences.index', compact('audiences'));
});
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AudienceController;

use App\Http\Controllers\SettingsController;

Route::get('/audiences', [AudienceController::class, 'index']);
Route::get('/audiences/create', [AudienceController::class, 'create']);
Route::post('/audiences/store', [AudienceController::class, 'store']);
Route::delete('/audiences/{id}', [AudienceController::class, 'destroy']);


Route::resource('audiences', AudienceController::class);
Route::get('/citizen/audiences', [AudienceController::class, 'citizenIndex']);

Route::get('/admin/statistiques', [AdminController::class, 'statistiques'])
->name('admin.statistiques');
Route::get('/citizen/audiences/search', [AudienceController::class, 'search']);






Route::get('/admin/settings', [SettingsController::class, 'index'])->name('settings');

Route::post('/admin/settings/update', [SettingsController::class, 'update'])->name('settings.update');


Route::get('/admin/settings', [SettingsController::class, 'index']);
Route::post('/admin/settings', [SettingsController::class, 'update']);
Route::get('/employee/dashboard', function () {

    $user = authUser();
    if (!$user || $user['role'] !== 'employee') return redirect('/login');

    return view('employee.dashboard', [
        'user'    => $user,
        'total'   => Dossier::count(),
        'enCours' => Dossier::where('status','en_cours')->count(),
        'termine' => Dossier::where('status','termine')->count(),
        'attente' => Dossier::where('status','attente')->count(),
        'latest'  => Dossier::latest()->take(5)->get(),
        'demandes'=> Demande::where('status','accepté')->latest()->take(10)->get()
    ]);
});
use App\Http\Controllers\CertificatController;

/* 📄 LIST DES CERTIFICATS */
Route::get('/certificats', [CertificatController::class, 'index']);

/* 🖨 PDF */
Route::get('/certificat/{id}/pdf', [CertificatController::class, 'pdf']);

/* 👁 VIEW SINGLE CERTIFICAT (اختياري) */
Route::get('/certificat/{id}', function ($id) {

    $certificat = App\Models\Certificat::with('user','demande')
        ->findOrFail($id);

    return view('certificats.show', compact('certificat'));
});
Route::post('/demandes/{id}/accept', [CertificatController::class, 'accept']);



use App\Http\Controllers\DossierController;

Route::get('/archives', [DossierController::class, 'archives'])->name('archives');
Route::get('/tribunal', function () {
    return view('tribunal');
});
Route::get('/back-to-dashboard', function () {

    $user = session('user');

    if (!$user) return redirect('/login');

    return match ($user['role']) {
        'admin' => redirect('/dashboard'),
        'employee' => redirect('/employee/dashboard'),
        'citizen' => redirect('/citizen/dashboard'),
        default => redirect('/login'),
    };
});
Route::get('/load/{page}', function ($page) {

    $pages = [
        'dashboard' => 'partials.dashboard',
        'dossiers' => 'partials.dossiers',
        'audiences' => 'partials.audiences',
        'archives' => 'partials.archives',
        'certificats' => 'partials.certificats',
    ];

    return view($pages[$page] ?? 'partials.dashboard');

});
Route::post('/contact', [MessageController::class, 'store']);