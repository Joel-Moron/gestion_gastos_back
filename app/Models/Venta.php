<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'venta';
    protected $fillable = [
        'fecha',
        'precio_venta',
        'cantidad',
        'producto_id',
        'usuario_id'
    ];
}
