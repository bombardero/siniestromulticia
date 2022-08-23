<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanioMaterial extends Model
{
    use HasFactory;
    protected $table = "danio_materiales";
    protected $fillable = ["carga_paso_7_danio_materiales_detalles", "carga_paso_7_danio_materiales_nombre", "carga_paso_7_danio_materiales_documento_id", "carga_paso_7_danio_materiales_documento_numero", "carga_paso_7_danio_materiales_codigo_postal", "carga_paso_7_danio_materiales_domicilio"];
}
