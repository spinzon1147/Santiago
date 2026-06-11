<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'Id_Cli';

    public $timestamps = false;

    protected $fillable = [
        'Nom_Cli',
        'Email_Cli',
        'Tel_Cli',
        'Direc_Cli',
        'Estado_Cli',
    ];

    public function scopeActive($query)
    {
        return $query->where('Estado_Cli', 'Activo');
    }
}
