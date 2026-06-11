<?php

namespace App\Services;

use App\Models\Producto;

class StockService
{
    public function decrementStock(Producto $producto, int $cantidad): void
    {
        $producto->Cant_pro -= $cantidad;
        $this->syncEstado($producto);
        $producto->save();
    }

    public function incrementStock(Producto $producto, int $cantidad): void
    {
        $producto->Cant_pro += $cantidad;
        $this->syncEstado($producto);
        $producto->save();
    }

    public function hasSufficientStock(Producto $producto, int $cantidad): bool
    {
        return $producto->Cant_pro >= $cantidad;
    }

    public function calculateTotal(Producto $producto, int $cantidad): float
    {
        return $producto->Precio_pro * $cantidad;
    }

    public function transferStock(Producto $oldProduct, int $oldCant, Producto $newProduct, int $newCant): void
    {
        if ($oldProduct->Id_pro === $newProduct->Id_pro) {
            $diff = $newCant - $oldCant;
            if ($diff > 0) {
                if (!$this->hasSufficientStock($oldProduct, $diff)) {
                    throw new \RuntimeException('Stock insuficiente en el producto seleccionado');
                }
                $this->decrementStock($oldProduct, $diff);
            } elseif ($diff < 0) {
                $this->incrementStock($oldProduct, abs($diff));
            }
        } else {
            $this->incrementStock($oldProduct, $oldCant);
            if (!$this->hasSufficientStock($newProduct, $newCant)) {
                $this->decrementStock($oldProduct, $oldCant);
                throw new \RuntimeException('Stock insuficiente en el producto seleccionado');
            }
            $this->decrementStock($newProduct, $newCant);
        }
    }

    public function syncEstado(Producto $producto): void
    {
        if ($producto->Cant_pro <= 0) {
            $producto->Estado_pro = 'Agotado';
        } elseif ($producto->Cant_pro <= 5) {
            $producto->Estado_pro = 'Bajo';
        } else {
            $producto->Estado_pro = 'Disponible';
        }
    }

    public function setStock(Producto $producto, int $nuevaCantidad): void
    {
        $producto->Cant_pro = max(0, $nuevaCantidad);
        $this->syncEstado($producto);
        $producto->save();
    }
}
