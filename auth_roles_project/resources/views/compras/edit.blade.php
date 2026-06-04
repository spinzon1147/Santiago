@extends('layouts.app')

@section('content')

<div class="container-custom">

<div class="card-custom">

<h2>Editar Compra</h2>

<form action="{{ route('compras.update',$compra->Id_Com) }}" method="POST">
@csrf
@method('PUT')

<label>Producto</label>
<select name="Id_Prod_FK">
    @foreach($productos as $producto)
        <option value="{{ $producto->Id_pro }}"
        {{ $compra->Id_Prod_FK == $producto->Id_pro ? 'selected' : '' }}>
            {{ $producto->Nom_pro }}
        </option>
    @endforeach
</select>

<label>Cantidad</label>
<input type="number" name="Cant_Com" value="{{ $compra->Cant_Com }}">

<label>Fecha</label>
<input type="datetime-local" name="Fecha_Com" value="{{ $compra->Fecha_Com }}">

<button type="submit">Actualizar</button>

</form>

</div>

</div>

@endsection