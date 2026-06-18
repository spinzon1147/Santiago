<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'Id_pro';

    protected $fillable = [
        'Nom_pro',
        'Cant_pro',
        'Precio_pro',
        'Estado_pro',
        'Descrip_pro',
    ];

    protected $casts = [
        'Precio_pro' => 'decimal:2',
        'Cant_pro' => 'integer',
    ];

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'Id_Prod_FK', 'Id_pro');
    }

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'Id_Prod_FK', 'Id_pro');
    }

    public function inventarios(): HasMany
    {
        return $this->hasMany(Inventario::class, 'Id_Producto', 'Id_pro');
    }

    public function scopeActive($query)
    {
        return $query->where('Estado_pro', 'Disponible');
    }

    public function scopeLowStock($query, int $threshold = 5)
    {
        return $query->where('Cant_pro', '<=', $threshold);
    }

    public function getStockLabelAttribute(): string
    {
        if ($this->Cant_pro <= 0) {
            return 'Agotado';
        }
        if ($this->Cant_pro <= 5) {
            return 'Bajo';
        }
        return 'Disponible';
    }
}
