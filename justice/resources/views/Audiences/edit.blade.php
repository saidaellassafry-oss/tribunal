
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modifier Audience</title>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#0f172a,#1e293b);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.box{
    width:100%;
    max-width:650px;
    background:#1e293b;
    border-radius:18px;
    padding:30px;
    box-shadow:0 15px 35px rgba(0,0,0,0.35);
}

h2{
    margin:0 0 25px;
    text-align:center;
    color:#38bdf8;
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}

.field{
    display:flex;
    flex-direction:column;
}

.field.full{
    grid-column:1 / -1;
}

label{
    margin-bottom:6px;
    font-size:14px;
    color:#cbd5e1;
}

input, select, textarea{
    padding:12px;
    border:none;
    border-radius:10px;
    background:#0f172a;
    color:white;
    outline:none;
}

textarea{
    resize:vertical;
    min-height:90px;
}

.actions{
    margin-top:25px;
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.btn{
    flex:1;
    padding:12px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
    text-decoration:none;
    text-align:center;
    transition:0.3s;
}

.btn-save{
    background:#22c55e;
    color:white;
}

.btn-save:hover{
    background:#16a34a;
    transform:translateY(-2px);
}

.btn-back{
    background:#38bdf8;
    color:white;
}

.btn-back:hover{
    background:#0ea5e9;
    transform:translateY(-2px);
}

.error{
    color:#f87171;
    font-size:13px;
    margin-top:5px;
}

@media(max-width:700px){
    .grid{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body>

<div class="box">

<h2>✏ Modifier Audience</h2>

<form method="POST" action="{{ route('audiences.update',$a->id) }}">
@csrf
@method('PUT')

<div class="grid">

<div class="field full">
<label>Titre</label>
<input type="text" name="titre" value="{{ old('titre',$a->titre) }}" required>
@error('titre') <span class="error">{{ $message }}</span> @enderror
</div>

<div class="field">
<label>Tribunal</label>
<input type="text" name="tribunal" value="{{ old('tribunal',$a->tribunal) }}">
</div>

<div class="field">
<label>Salle</label>
<input type="text" name="salle" value="{{ old('salle',$a->salle) }}">
</div>

<div class="field">
<label>Date Audience</label>
<input type="date" name="date_audience" value="{{ old('date_audience',$a->date_audience) }}">
</div>

<div class="field">
<label>Heure</label>
<input type="time" name="heure" value="{{ old('heure',$a->heure) }}">
</div>

<div class="field">
<label>Juge</label>
<input type="text" name="juge" value="{{ old('juge',$a->juge) }}">
</div>

<div class="field">
<label>Statut</label>
<select name="status">
<option value="planifie" {{ $a->status=='planifie' ? 'selected' : '' }}>Planifié</option>
<option value="terminee" {{ $a->status=='terminee' ? 'selected' : '' }}>Terminée</option>
<option value="reportee" {{ $a->status=='reportee' ? 'selected' : '' }}>Reportée</option>
</select>
</div>

<div class="field">
<label>Défenseur</label>
<input type="text" name="defenseur" value="{{ old('defenseur',$a->defenseur) }}">
</div>

<div class="field">
<label>Accusé</label>
<input type="text" name="accuse" value="{{ old('accuse',$a->accuse) }}">
</div>

<div class="field full">
<label>Dossier</label>
<select name="dossier_id">
<option value="">Choisir dossier</option>

@foreach($dossiers as $d)
<option value="{{ $d->id }}" {{ $a->dossier_id == $d->id ? 'selected' : '' }}>
{{ $d->title ?? ('Dossier #'.$d->id) }}
</option>
@endforeach

</select>
</div>

<div class="field full">
<label>Notes</label>
<textarea name="notes">{{ old('notes',$a->notes) }}</textarea>
</div>

</div>

<div class="actions">
<button type="submit" class="btn btn-save">💾 Modifier</button>
<a href="/audiences" class="btn btn-back">⬅ Retour</a>
</div>

</form>

</div>

</body>
</html>

