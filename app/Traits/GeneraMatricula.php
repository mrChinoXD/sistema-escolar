<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait GeneraMatricula
{
    public function generarMatricula(): string
    {
        $anio = Carbon::now()->year;

        $ultimoConsecutivo = DB::table('alumnos')
            ->where('matricula', 'like', "UNI{$anio}%")
            ->count();

        $nuevoConsecutivo = $ultimoConsecutivo + 1;

        $numeroFormateado = str_pad($nuevoConsecutivo, 3, '0', STR_PAD_LEFT);

        return "UNI{$anio}{$numeroFormateado}";
    }
}
