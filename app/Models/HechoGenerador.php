<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HechoGenerador extends Model
{
    use HasFactory;

    protected $table = "hechos_generadores";

    protected $fillable = [
        "nombre",
        "codigo_compania",
    ];

    public function denuncias()
    {
        return $this->hasMany(DenunciaSiniestro::class);
    }
}
