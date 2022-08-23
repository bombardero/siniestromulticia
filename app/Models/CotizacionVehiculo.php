<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionVehiculo extends Model
{
    use HasFactory;
	protected $casts = [
	    'coberturas' => 'array',
	];
    protected $fillable = ["tipo", "año", "marca", "modelo", "usos", "codigo_postal", "email", "numero", "coberturas", "provincia"];
}
