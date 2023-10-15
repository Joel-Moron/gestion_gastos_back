<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoGasto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tipo_gasto';
    protected $fillable = [
        'nombre',
        'usuario_id'
    ];
}
