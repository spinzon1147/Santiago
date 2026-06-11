<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Requests\StoreProveedorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProveedorController extends Controller
{
    public function index(): View
    {
        $proveedores = Proveedor::all();

        return view('proveedores.index', compact('proveedores'));
    }

    public function create(): View
    {
        return view('proveedores.create');
    }

    public function store(StoreProveedorRequest $request): RedirectResponse
    {
        Proveedor::create($request->validated());

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente');
    }

    public function show(string $id): View
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(string $id): View
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(StoreProveedorRequest $request, string $id): RedirectResponse
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->validated());

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy(string $id): RedirectResponse
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente');
    }
}
