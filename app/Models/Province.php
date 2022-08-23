<?php

namespace App\Models;

use App\Models\Asegurable;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;


       public function users()
    {
        return $this->hasMany('App\Models\User');
    }

       public function inquilinos()
    {
        return $this->hasMany('App\Models\Inquilino');
    }
       public function propietarios()
    {
        return $this->hasMany('App\Models\Propietario');
    }

      public function cities()
    {
      return $this->hasMany(City::class);
    }
      public function asegurables()
    {
      return $this->hasMany(Asegurable::class);
    }    
}
