<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testigo extends Model
{
    use HasFactory;

    protected $table = 'reclamo_testigos';

    protected $fillable = [
        'nombre',
        'telefono',
        'domicilio',
        'pais_id',
        'province_id',
        'city_id',
        'otro_pais_provincia_localidad',
    ];

    public function getDomicilioCompletoAttribute()
    {
        $domicilio_completo = $this->domicilio;
        if($this->city_id != null && $this->province_id != null && $this->pais_id != null)
        {
            $domicilio_completo .= ', '.$this->localidad->name.', '.$this->provincia->name.', '.$this->pais->nombre;
        } elseif ($this->province_id != null && $this->pais_id != null)
        {
            $domicilio_completo .= ', '.$this->otro_pais_provincia_localidad.', '.$this->provincia->name.', '.$this->pais->nombre;
        } else {
            $domicilio_completo .= ', '.$this->otro_pais_provincia_localidad;
        }
        return $domicilio_completo;
    }

    public function reclamo()
    {
        return $this->belongsTo(ReclamoTercero::class, 'reclamo_tercero_id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function provincia()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function localidad()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
