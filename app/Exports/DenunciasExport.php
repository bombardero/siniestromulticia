<?php

namespace App\Exports;

use App\Models\DenunciaSiniestro;
use Maatwebsite\Excel\Concerns\FromCollection;

class DenunciasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DenunciaSiniestro::all();
    }
}
