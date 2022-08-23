<?php

namespace App\Models;

use App\Models\City;
use App\Models\DatosPolizaSepelio;
use App\Models\GrupoFamiliar;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asegurable extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function polizaSepelio() 
    {
        return $this->hasOne(DatosPolizaSepelio::class);
    }    

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function familia()
    {
      return $this->hasMany(GrupoFamiliar::class);
    }
}
