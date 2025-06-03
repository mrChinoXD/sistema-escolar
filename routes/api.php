<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

Route::apiResource('alumnos', AlumnoController::class);
Route::get('alumnos/{matricula}/get',[AlumnoController::class,'obtenerAlumno']);
