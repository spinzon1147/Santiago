@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --naranja-suave: #FFF0E6;
        --texto: #2D1A00;
        --crema: #FFF8F2;
        --gris: #666;
    }

    body {
        background: linear-gradient(to bottom right, #FFF8F2, #FFF1E5);
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 40px 20px;
    }

    .form-card {
        width: 100%;
        max-width: 600px;
        background: #fff;
        border-radius: 28px;
        padding: 40px;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
    }

    .title {
        text-align: center;
        font-size: 26px;
        font-weight: 700;
        color: var(--texto);
        margin-bottom: 30px;
    }

    .title i {
        color: var(--naranja);
        margin-right: 8px;
    }

    label {
        display: block;
        margin-top: 15px;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--texto);
    }

    input,
    select {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #f3d7c2;
        font-size: 15px;
        outline: none;
        transition: .2s;
        font-family: 'Poppins', sans-serif;
    }

    input:focus,
    select:focus {
        border-color: var(--naranja);
        box-shadow: 0 0 0 3px rgba(255,107,26,.15);
    }

    .buttons {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-primary {
        flex: 1;
        background: var(--naranja);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: .2s;
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
    }

    .btn-secondary {
        flex: 1;
        background: #f1f1f1;
        color: #444;
        padding: 14px;
        border-radius: 50px;
        text-decoration: none;
        text-align: center;
        font-weight: 600;
        transition: .2s;
    }

    .btn-secondary:hover {
        background: #e3e3e3;
    }

    .info-box {
        background: #FFF0E6;
        border-radius: 15px;
        padding: 20px;
        margin-top: 20px;
    }

    .total {
        font-size: 24px;
        color: #FF6B1A;
        font-weight: 700;
        margin-top: 10px;
    }
</style>

<div class="form-container">

    <div class="form-card">

        <div class="title">
            <i class="fa-solid fa-pen-to-square"></i>
            Actualizar Venta
        </div>

        <form action="{{ route('ventas.update', $venta->Id_Ven) }}" method="POST">

            @csrf
            @method('PUT')

            <label>Fecha</label>
            <input
                type="datetime-local"
                name="Fecha_Ven"
                value="{{ date('Y-m-d\TH:i', strtotime($venta->Fecha_Ven)) }}"
                required>

            <label>Cantidad</label>
            <input
                type="number"
                name="Cant_Ven"
                id="cantidad"
                min="1"
                value="{{ $venta->Cant_Ven }}"
                required>

            <label>Producto</label>

            <select name="Id_Prod_FK" id="producto" required>

                @foreach($productos as $producto)

                    <option
                        value="{{ $producto->Id_pro }}"
                        data-precio="{{ $producto->Precio_pro }}"
                        data-stock="{{ $producto->Cant_pro }}"
                        {{ $venta->Id_Prod_FK == $producto->Id_pro ? 'selected' : '' }}>

                        {{ $producto->Nom_pro }}
                        - Stock: {{ $producto->Cant_pro }}
                        - ${{ number_format($producto->Precio_pro, 0, ',', '.') }}

                    </option>

                @endforeach

            </select>

            <div class="info-box">

                <p>
                    <strong>Precio Unitario:</strong>
                    <span id="precio">$0</span>
                </p>

                <p>
                    <strong>Stock Disponible:</strong>
                    <span id="stock">0</span>
                </p>

                <p class="total">
                    Total: <span id="totalVista">$0</span>
                </p>

            </div>

            <input
                type="hidden"
                name="Valor_Ven"
                id="total"
                value="{{ $venta->Valor_Ven }}">

            <div class="buttons">

                <button type="submit" class="btn-primary">
                    Actualizar
                </button>

                <a href="{{ route('ventas.index') }}" class="btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

<script>

const producto = document.getElementById('producto');
const cantidad = document.getElementById('cantidad');

const precio = document.getElementById('precio');
const stock = document.getElementById('stock');
const totalVista = document.getElementById('totalVista');
const total = document.getElementById('total');

function calcular() {

    const opcion = producto.options[producto.selectedIndex];

    if (!opcion) return;

    const precioUnitario = parseInt(opcion.dataset.precio) || 0;
    const stockDisponible = parseInt(opcion.dataset.stock) || 0;
    const cant = parseInt(cantidad.value) || 0;

    const valorTotal = precioUnitario * cant;

    precio.innerHTML =
        '$' + precioUnitario.toLocaleString('es-CO');

    stock.innerHTML =
        stockDisponible;

    totalVista.innerHTML =
        '$' + valorTotal.toLocaleString('es-CO');

    total.value = valorTotal;
}

producto.addEventListener('change', calcular);
cantidad.addEventListener('input', calcular);

window.addEventListener('load', calcular);

</script>

@endsection