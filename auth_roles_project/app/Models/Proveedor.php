<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedors';
    protected $primaryKey = 'Id_Prov';

    public $timestamps = false;

    protected $fillable = [
        'Nom_Prov',
        'Tel_Prov',
        'Direc_Prov',
        'Estado_Prov',
    ];

    public function scopeActive($query)
    {
        return $query->where('Estado_Prov', 'Activo');
    }
}
