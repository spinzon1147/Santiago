<section class="delete-section">

<style>
    :root {
        --rojo: #DC3545;
        --rojo-oscuro: #b02a37;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .delete-section {
        max-width: 650px;
        margin: auto;
        padding: 40px 20px;
    }

    .delete-card {
        background: white;
        border-radius: 25px;
        padding: 30px;
        border: 2px solid #FFD4B0;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .title {
        font-family: 'Baloo 2', cursive;
        font-size: 1.8rem;
        color: var(--texto);
        margin-bottom: 5px;
    }

    .subtitle {
        font-size: 14px;
        color: #7A4A1A;
        margin-bottom: 20px;
    }

    .btn-danger {
        background: var(--rojo);
        color: white;
        padding: 10px 18px;
        border-radius: 50px;
        border: none;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-danger:hover {
        background: var(--rojo-oscuro);
    }

    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }

    .modal-box {
        background: white;
        padding: 25px;
        border-radius: 20px;
        max-width: 500px;
        width: 90%;
    }

    .modal-title {
        font-size: 1.3rem;
        margin-bottom: 10px;
        color: var(--texto);
    }

    .input {
        width: 100%;
        padding: 10px;
        border-radius: 12px;
        border: 1px solid #ddd;
        margin-top: 10px;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-cancel {
        background: #eee;
        padding: 10px 16px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
    }
</style>

<div class="delete-card">

    <div class="title">⚠️ Eliminar cuenta</div>

    <p class="subtitle">
        Una vez elimines tu cuenta, toda tu información será borrada permanentemente.
        Esta acción no se puede deshacer.
    </p>

    <button type="button" class="btn-danger" onclick="document.getElementById('modalDelete').style.display='flex'">
        Eliminar cuenta
    </button>

</div>

<!-- MODAL SIMPLE -->
<div class="modal" id="modalDelete">

    <div class="modal-box">

        <div class="modal-title">
            ¿Estás seguro de eliminar tu cuenta?
        </div>

        <p style="font-size:14px; color:#666;">
            Escribe tu contraseña para confirmar esta acción.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <input 
                type="password" 
                name="password" 
                class="input"
                placeholder="Contraseña"
                required
            >

            @error('password', 'userDeletion')
                <p style="color:red; font-size:13px;">{{ $message }}</p>
            @enderror

            <div class="actions">

                <button type="button" class="btn-cancel"
                    onclick="document.getElementById('modalDelete').style.display='none'">
                    Cancelar
                </button>

                <button type="submit" class="btn-danger">
                    Confirmar
                </button>

            </div>

        </form>

    </div>

</div>

</section>