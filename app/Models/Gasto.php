<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'gasto';
    protected $fillable = [
        'nombre',
        'fecha',
        'precio',
        'tipo_gasto_id',
        'usuario_id'
    ];
}
