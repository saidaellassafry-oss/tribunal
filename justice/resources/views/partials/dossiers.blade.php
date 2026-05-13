<h2>📁 Gestion des Dossiers</h2>

<!-- TOP BAR -->
<div style="display:flex; justify-content:space-between; align-items:center; margin:15px 0;">

    <button style="
        background:green;
        color:white;
        border:none;
        padding:10px 15px;
        border-radius:8px;
        cursor:pointer;">
        ➕ Ajouter dossier
    </button>

    <input type="text" placeholder="🔍 Rechercher dossier..."
        style="padding:10px; width:250px; border-radius:8px; border:none;">
</div>

<hr>

<!-- DOSSIERS GRID -->
<div style="display:grid; grid-template-columns:repeat(2,1fr); gap:15px;">

    <!-- CARD -->
    <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:12px;">
        <h3>📁 hhhhh</h3>
        <p>#️⃣ N°: 99</p>
        <p>📂 Type: Commercial</p>
        <p>👤 Client: n</p>
        <p>⚖ Statut: <span style="color:lime;">Terminé</span></p>

        <div style="margin-top:10px;">
            <button style="padding:5px 10px;">✏ Modifier</button>
            <button style="padding:5px 10px; background:red; color:white;">🗑 Supprimer</button>
        </div>
    </div>

    <!-- CARD -->
    <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:12px;">
        <h3>📁 n</h3>
        <p>#️⃣ N°: 123\01\56</p>
        <p>📂 Type: Commercial</p>
        <p>👤 Client: n</p>
        <p>⚖ Statut: <span style="color:orange;">En cours</span></p>

        <div style="margin-top:10px;">
            <button style="padding:5px 10px;">✏ Modifier</button>
            <button style="padding:5px 10px; background:red; color:white;">🗑 Supprimer</button>
        </div>
    </div>

    <!-- CARD -->
    <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:12px;">
        <h3>📁 g</h3>
        <p>#️⃣ N°: 122</p>
        <p>📂 Type: Commercial</p>
        <p>👤 Client: l</p>
        <p>⚖ Statut: <span style="color:lime;">Terminé</span></p>

        <div style="margin-top:10px;">
            <button>✏ Modifier</button>
            <button style="background:red; color:white;">🗑 Supprimer</button>
        </div>
    </div>

    <!-- CARD -->
    <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:12px;">
        <h3>📁 bjuy</h3>
        <p>#️⃣ N°: 123-123</p>
        <p>📂 Type: Pénal</p>
        <p>👤 Client: v</p>
        <p>⚖ Statut: <span style="color:orange;">En cours</span></p>

        <div style="margin-top:10px;">
            <button>✏ Modifier</button>
            <button style="background:red; color:white;">🗑 Supprimer</button>
        </div>
    </div>

</div>