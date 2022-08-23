<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosAnexos extends Model
{
    use HasFactory;

	protected $fillable = [ 'tipo', 'url' ];

}
