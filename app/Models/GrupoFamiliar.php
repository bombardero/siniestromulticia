<?php

namespace App\Models;

use App\Models\Asegurable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoFamiliar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function asegurable()
    {
    	return $this->belongsTo(Asegurable::class);
    }
}
