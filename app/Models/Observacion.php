<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;
    protected $fillable = ['detalle','user_id'];
    protected $table = "observaciones";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
