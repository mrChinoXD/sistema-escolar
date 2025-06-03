<?php

namespace App\Models;

use App\Traits\GeneraMatricula;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Alumno extends Model
{
    use HasFactory, Notifiable,SoftDeletes,GeneraMatricula;

    protected $table = 'alumnos';

    protected $fillable = [
        'nombre',
        'apellido',
        'apellido_materno',
        'email',
        'sede_id',
        'matricula',
    ];

    function sede(){
        return $this->belongsTo(Sede::class,'sede_id');
    }

    protected static function booted()
    {
        static::creating(function ($alumno) {
            $alumno->matricula = $alumno->generarMatricula();
        });
    }




}
