<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class DenunciaSiniestro extends Model
{
    use HasFactory, SoftDeletes;

    const ESTADOS = ['ingresado', 'aceptado', 'rechazado', 'cerrado', 'legales', 'investigacion'];
    const COBERTURAS_ACTIVAS = ['RC', 'Casco', 'RC con Casco'];

    protected $fillable = [
        "identificador",
        "estado_carga",
        "dominio_vehiculo_asegurado",
        "fecha",
        "hora",
        "lugar_nombre",
        "codigo_postal",
        "direccion",
        "nombre_conductor",
        "descripcion",
        "responsable_contacto_nombre",
        "responsable_contacto_domicilio",
        "responsable_contacto_telefono",
        "responsable_contacto_email",

        "province_id",
        "city_id",
        "calle",
        "tipo_calzada_id",
        "calzada_detalle",
        "interseccion",
        "cruce_senalizado",
        "tren",
        "semaforo",
        "semaforo_funciona",
        "semaforo_intermitente",
        "semaforo_color",

        "intervino_otro_vehiculo",
        "intervino_otro_vehiculo_datos",

        "hubo_danios_materiales",
        "hubo_lesionados",

        "denuncia_policial_comisaria",
        "denuncia_policial_acta",
        "denuncia_policial_folio",
        "denuncia_policial_sumario",
        "denuncia_policial_juzgado",
        "denuncia_policial_secretaria",

        "croquis_url",
        "croquis_path",
        "croquis_descripcion"
    ];

    protected $casts = [
        'cruce_senalizado' => 'boolean',
        'tren' => 'boolean',
        'semaforo' => 'boolean',
        'semaforo_funciona' => 'boolean',
        "semaforo_intermitente" => 'boolean',
        'intervino_otro_vehiculo' => 'boolean',
        'intervino_otro_vehiculo_datos' => 'boolean',
        'hubo_danios_materiales' => 'boolean',
        'hubo_lesionados' => 'boolean',
        'tipo_accidente_frontal' => 'boolean',
        'tipo_accidente_posterior' => 'boolean',
        'tipo_accidente_cadena' => 'boolean',
        'tipo_accidente_lateral' => 'boolean',
        'tipo_accidente_vuelco' => 'boolean',
        'tipo_accidente_desplaza' => 'boolean',
        'tipo_accidente_incendio' => 'boolean',
        'tipo_accidente_inmersion' => 'boolean',
        'tipo_accidente_explosion' => 'boolean',
        'tipo_accidente_carga' => 'boolean',
        'tipo_accidente_otros' => 'boolean',
        'lugar_autopista' => 'boolean',
        'lugar_calle' => 'boolean',
        'lugar_avenida' => 'boolean',
        'lugar_curva' => 'boolean',
        'lugar_pendiente' => 'boolean',
        'lugar_tunel' => 'boolean',
        'lugar_puente' => 'boolean',
        'lugar_otros' => 'boolean',
        'colision_peaton' => 'boolean',
        'colision_vehiculo' => 'boolean',
        'colision_edificio' => 'boolean',
        'colision_columna' => 'boolean',
        'colision_animal' => 'boolean',
        'colision_transporte_publico' => 'boolean',
    ];

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

    public function conductor()
    {
        return $this->hasOne(Conductor::class)->latest();
    }

    public function asegurado()
    {
        return $this->hasOne(Asegurado::class)->latest();
    }

    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class)->latest();
    }

    public function vehiculoTerceros()
    {
        return $this->hasMany(VehiculoTercero::class);
    }

    public function danioMateriales()
    {
        return $this->hasMany(DanioMaterial::class);
    }

    public function lesionados()
    {
        return $this->hasMany(Lesionado::class);
    }

    public function detalleSiniestro()
    {
        return $this->hasOne(DetalleSiniestro::class);
    }

    public function documentosDenuncia()
    {
        return $this->hasMany(DocumentosDenuncia::class);
    }

    public function denunciante()
    {
        return $this->hasOne(Denunciante::class)->latest();
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class)->latest();
    }

    public function canEdit()
    {
        return Auth::check() || $this->estado_carga == 'precarga' || (is_numeric($this->estado_carga) && $this->estado_carga < 12);
    }
}
