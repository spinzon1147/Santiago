<section class="reset-section">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .reset-section {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: var(--crema);
        padding: 20px;
    }

    .card {
        background: white;
        width: 100%;
        max-width: 450px;
        padding: 30px;
        border-radius: 25px;
        border: 2px solid #FFD4B0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .title {
        font-family: 'Baloo 2', cursive;
        font-size: 1.6rem;
        margin-bottom: 15px;
        color: var(--texto);
        text-align: center;
    }

    label {
        font-weight: 700;
        font-size: 14px;
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 12px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        outline: none;
    }

    input:focus {
        border-color: var(--naranja);
    }

    .btn-primary {
        width: 100%;
        background: var(--naranja);
        color: white;
        padding: 12px;
        border-radius: 50px;
        border: none;
        font-weight: 800;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
    }

    .error {
        color: red;
        font-size: 13px;
        margin-top: -10px;
        margin-bottom: 10px;
    }
</style>

<div class="card">

    <div class="title">🔑 Restablecer contraseña</div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- TOKEN -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- EMAIL -->
        <label>Email</label>
        <input 
            type="email"
            name="email"
            value="{{ old('email', $request->email) }}"
            required
            autofocus
        >
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- PASSWORD -->
        <label>Nueva contraseña</label>
        <input 
            type="password"
            name="password"
            required
        >
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- CONFIRM -->
        <label>Confirmar contraseña</label>
        <input 
            type="password"
            name="password_confirmation"
            required
        >
        @error('password_confirmation')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn-primary">
            Restablecer contraseña
        </button>

    </form>

</div>

</section>