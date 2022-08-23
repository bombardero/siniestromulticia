<?php

namespace App\Models;

use App\Models\Asegurable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
	public $timestamps = true;

	public function province()
	{
		return $this->belongsTo('App\Province');
	}

	public function users()
	{
		return $this->hasMany('App\User');
	}

	public function inquilinos()
	{
		return $this->hasMany('App\Inquilino');
	}

	public function propietarios()
	{
		return $this->hasMany('App\Propietario');
	}	

    public function asegurable()
    {
      return $this->hasMany(Asegurable::class);
    }


}

