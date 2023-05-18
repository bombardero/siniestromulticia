<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReclamoTercero extends Model
{
    use HasFactory, SoftDeletes;

    const ESTADOS = [
        'ingresado' => 'Ingresado',
        'aceptado' => 'Aceptado',
        'rechazado' => 'Rechazado',
        'cerrado' => 'Cerrado',
        'legales' => 'Legales',
        'investigacion' => 'Investigación',
        'derivado-proveedor' => 'Derivado a proveedor',
        'solicitud-documentacion' => 'Solicitud de documentación',
        'informe-pericial' => 'Informe Pericial',
    ];

    protected $fillable = [
        'identificador',
        'estado',
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
        return $this->hasOne(VehiculoReclamo::class);
    }

    public function conductor()
    {
        return $this->hasOne(ConductorReclamo::class);
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

    public function lesionados()
    {
        return $this->hasMany(LesionadoReclamo::class, 'reclamo_tercero_id');
    }

    public function daniosMateriales()
    {
        return $this->hasMany(DanioMaterialReclamo::class, 'reclamo_tercero_id');
    }

    public function documentosVehicularCompleto()
    {
        if($this->reclamo_vehicular && !$this->vehiculo)
        {
            return false;
        }

        if($this->reclamo_vehicular && $this->vehiculo)
        {
            if($this->vehiculo->documentos->where('type', 'dv_dni_titular')->count() < 2 )
            {
                return false;
            }

            if($this->vehiculo->documentos->where('type','dv_cedula')->count() < 2 )
            {
                return false;
            }

            if($this->vehiculo->documentos->where('type','dv_carnet')->count() < 2 )
            {
                return false;
            }

            if($this->vehiculo->en_transferencia && $this->vehiculo->documentos->where('type','dv_formulario_08')->count() < 1 )
            {
                return false;
            }

            if($this->vehiculo->con_seguro && $this->vehiculo->documentos->where('type','dv_denuncia_administrativa')->count() < 1 )
            {
                return false;
            }

            if($this->vehiculo->con_seguro && $this->vehiculo->documentos->where('type','dv_certificado_cobertura')->count() < 1 )
            {
                return false;
            }

            if(!$this->vehiculo->con_seguro && $this->vehiculo->documentos->where('type','dv_declaracion_jurada')->count() < 1 )
            {
                return false;
            }

            if($this->vehiculo->documentos->where('type','dv_vehiculo')->count() < 4 )
            {
                return false;
            }

            if($this->vehiculo->documentos->where('type','dv_presupuesto')->count() < 1)
            {
                return false;
            }
        }

        return true;
    }

    public function documentosDaniosMaterialesCompleto()
    {

        if($this->reclamo_danios_materiales && !$this->daniosMateriales)
        {
            return false;
        }

        foreach ($this->daniosMateriales as $danio_material)
        {
            if($danio_material->documentos()->where('type', 'dm_denuncia_policial')->count() < 1)
            {
                return false;
            }
            if($danio_material->documentos()->where('type', 'dm_dni_propietario')->count() < 2)
            {
                return false;
            }
            if($danio_material->documentos()->where('type', 'dm_escritura_contrato_alquiler')->count() < 1)
            {
                return false;
            }
            if($danio_material->documentos()->where('type', 'dm_fotos_danios')->count() < 1)
            {
                return false;
            }
            if($danio_material->documentos()->where('type', 'dm_presupuesto')->count() < 1)
            {
                return false;
            }
        }

        return true;
    }

    public function documentosLesionadosCompleto()
    {
        if($this->reclamo_lesiones && (!$this->conductor->lesiones || !$this->lesionados))
        {
            return false;
        }

        if($this->conductor && $this->conductor->lesiones)
        {
            if($this->conductor->documentos()->where('type', 'dl_dni')->count() < 2)
            {
                return false;
            }
            if($this->conductor->documentos()->where('type', 'dl_dni_tutor')->count() < 2)
            {
                return false;
            }
            if($this->conductor->documentos()->where('type', 'dl_denuncia_policial')->count() < 1)
            {
                return false;
            }
            if($this->conductor->documentos()->where('type', 'dl_historia_clinica')->count() < 1)
            {
                return false;
            }
            if($this->conductor->documentos()->where('type', 'dl_gastos_medicos')->count() < 1)
            {
                return false;
            }
        }

        foreach ($this->lesionados as $lesionado)
        {
            if($lesionado->documentos()->where('type', 'dl_dni')->count() < 2)
            {
                return false;
            }
            if($lesionado->documentos()->where('type', 'dl_dni_tutor')->count() < 2)
            {
                return false;
            }
            if($lesionado->documentos()->where('type', 'dl_denuncia_policial')->count() < 1)
            {
                return false;
            }
            if($lesionado->documentos()->where('type', 'dl_historia_clinica')->count() < 1)
            {
                return false;
            }
            if($lesionado->documentos()->where('type', 'dl_gastos_medicos')->count() < 1)
            {
                return false;
            }
        }

        return true;
    }

}
