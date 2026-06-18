<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'Id_Ven';

    protected $fillable = [
        'Id_Prod_FK',
        'Cant_Ven',
        'Total_Ven',
        'Fecha_Ven',
    ];

    protected $casts = [
        'Total_Ven' => 'decimal:2',
        'Cant_Ven' => 'integer',
        'Fecha_Ven' => 'date',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'Id_Prod_FK', 'Id_pro');
    }

    public function getSubtotalAttribute(): float
    {
        return (float) $this->Total_Ven;
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('Fecha_Ven', $date);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('Fecha_Ven', now());
    }
}
