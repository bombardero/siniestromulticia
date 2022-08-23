<?php

namespace App\Models;

use App\Models\DatosPolizaSepelio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function polizaSepelios()
    {
    	return $this->belongsToMany(DatosPolizaSepelio::class)->withPivot('datos_poliza_sepelio_id');
    }   
}
