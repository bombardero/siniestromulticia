<?php

namespace App\Models;

use App\Models\Asegurable;
use App\Models\Beneficiario;
use App\Models\Productor;
use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosPolizaSepelio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function asegurable() 
    {
        return $this->belongsTo(Asegurable::class);
    }
    public function productor() 
    {
        return $this->belongsTo(Productor::class);
    }
    public function beneficiarios()
    {
    	return $this->belongsToMany(Beneficiario::class)->withPivot('beneficiario_id');
    }

}
