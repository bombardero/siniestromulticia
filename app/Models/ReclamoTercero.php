<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReclamoTercero extends Model
{
    use HasFactory, SoftDeletes;

    const ESTADOS = [
        'ingresado',
        'aceptado',
        'rechazado',
        'cerrado',
        'legales',
        'investigacion',
        'derivado-proveedor',
        'solicitud-documentacion',
        'informe-pericial',
        'pendiente-de-pago',
        'esperando-baja-de-unidad'
    ];

    protected $fillable = [
        'identificador',
        'estado_carga',
        'vehiculo_asegurado_dominio',
        'vehiculo_tercero_dominio',
        'fecha',
        'hora',
        'lugar_nombre',
        'codigo_postal',
        'direccion',
        'descripcion',
        'responsable_contacto_nombre',
        'responsable_contacto_domicilio',
        'responsable_contacto_telefono',
        'responsable_contacto_email',
        'asegurado_nombre',
        'vehiculo_asegurado_nro_poliza',
        'vehiculo_asegurado_marca_id',
        'vehiculo_asegurado_modelo_id',
        'vehiculo_asegurado_otra_marca',
        'vehiculo_asegurado_otro_modelo',

        'reclamo_vehicular',
        'reclamo_danios_materiales',
        'reclamo_lesiones',

        "finalized_at"
    ];

    protected $casts = [
        'reclamo_vehicular' => 'boolean',
        'reclamo_danios_materiales' => 'boolean',
        'reclamo_lesiones' => 'boolean',
        'finalized_at' => 'datetime'
    ];

    protected $dates = ['fecha'];

    public function getTiposReclamosAttribute()
    {
        $tiposReclamos = [];
        if($this->reclamo_vehicular)
        {
            array_push($tiposReclamos, 'Vehicular');
        }
        if($this->reclamo_danios_materiales)
        {
            array_push($tiposReclamos, 'Daños Materiales');
        }
        if($this->reclamo_lesiones)
        {
            array_push($tiposReclamos,'Lesiones');
        }
        return $tiposReclamos;
    }

    public function reclamante()
    {
        return $this->hasOne(Reclamante::class);
    }

    public function vehiculo()
    {
        return $this->hasOne(VehiculoReclamante::class);
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

    public function tipoCalzada()
    {
        return $this->belongsTo(TipoCalzada::class);
    }

    public function marcaVehiculoAsegurado()
    {
        return $this->belongsTo(Marca::class, 'vehiculo_asegurado_marca_id');
    }

    public function modeloVehiculoAsegurado()
    {
        return $this->belongsTo(Modelo::class, 'vehiculo_asegurado_modelo_id');
    }

    public function testigos()
    {
        return $this->hasMany(Testigo::class, 'reclamo_tercero_id');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentosReclamo::class);
    }

}
