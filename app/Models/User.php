<?php

namespace App\Models;

use App\Models\Productor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cuit',
        'telefono',
        'direccion',
        'city_id',
        'province_id',
        'codigo_postal',
        'matricula_pas'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function solicitudes()
    {
        return $this->hasMany('App\Models\Solicitud');
    }

    public function denunciasSiniestro()
    {
        return $this->hasMany(DenunciaSiniestro::class);
    }

    // public function productor()
    // {
    //     return $this->hasOne(Productor::class);
    // }

}

