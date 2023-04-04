<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DenunciaSiniestro extends Model
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

        "pais_id",
        "province_id",
        "city_id",
        "otro_pais_provincia_localidad",
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

        'tipo_accidente_frontal',
        'tipo_accidente_posterior',
        'tipo_accidente_cadena',
        'tipo_accidente_lateral',
        'tipo_accidente_vuelco',
        'tipo_accidente_desplaza',
        'tipo_accidente_incendio',
        'tipo_accidente_inmersion',
        'tipo_accidente_explosion',
        'tipo_accidente_carga',
        'tipo_accidente_otros',

        'lugar_autopista',
        'lugar_calle',
        'lugar_avenida',
        'lugar_curva',
        'lugar_pendiente',
        'lugar_tunel',
        'lugar_puente',
        'lugar_otros',

        'colision_peaton',
        'colision_vehiculo',
        'colision_edificio',
        'colision_columna',
        'colision_animal',
        'colision_transporte_publico',
        'colision_otros',

        "denuncia_policial_comisaria",
        "denuncia_policial_acta",
        "denuncia_policial_folio",
        "denuncia_policial_sumario",
        "denuncia_policial_juzgado",
        "denuncia_policial_secretaria",

        "croquis_url",
        "croquis_path",
        "croquis_descripcion",

        "nro_poliza",
        "nro_denuncia",
        "nro_siniestro",
        "estado",
        "observacion_estado",
        "link_enviado",

        "certificado_cobertura_name",
        "certificado_cobertura_url",
        "certificado_cobertura_path",

        "finalized_at"
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
        'colision_otros' => 'boolean',
        'link_enviado' => 'boolean',

        'finalized_at' => 'datetime'
    ];

    protected $dates = ['fecha'];

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
        return $this->hasMany(Observacion::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function canEdit()
    {
        return Auth::check() || $this->estado_carga == 'precarga' || (is_numeric($this->estado_carga) && $this->estado_carga < 12);
    }

    public function storeCertificadoCobertura(string $url_cerificado)
    {
        if($this->certificado_cobertura_url)
        {
            Storage::disk('s3')->delete($this->certificado_cobertura_url);
        }
        $fileName = 'certificado_de_cobertura_'.Carbon::now()->format('Ymd_His').'.pdf';
        $filePath = 'denuncia_siniestro/'.$this->id.'/'.$fileName;

        Storage::disk('s3')->put($filePath, file_get_contents($url_cerificado),'public');
        $url = Storage::disk('s3')->url($filePath);

        $this->certificado_cobertura_name = $fileName;
        $this->certificado_cobertura_path = $filePath;
        $this->certificado_cobertura_url = $url;
        $this->save();
    }
}
