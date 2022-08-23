<?php

namespace App\Models;

use App\Models\DatosPolizaSepelio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    use HasFactory;

    protected $fillable = ["nombre_productor", "codigo"];

    public function polizaSepelio()
	{
		return $this->hasMany(DatosPolizaSepelio::class);
	}

}
