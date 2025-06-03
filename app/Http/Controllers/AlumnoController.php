<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAlumnoRequest;
use App\Mail\BienvenidaAlumnoMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Responses\ApiResponse;
use App\Http\Requests\CreateAlumnoRequest;
use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        try{
            $limit = $request->query('limit', 10);
            $alumnos = Alumno::take($limit)->get();
            $alumnos->load('sede');
            return ApiResponse::success($alumnos, 'listado de Alumnos', 201);
        }catch(\Exception $e){
            return ApiResponse::error('Error al obtener Alumnos', ['exception' => $e->getMessage()], 500);
        }
    }
    public function store(CreateAlumnoRequest $request)
    {
        try{
            $alumno = Alumno::create($request->all());

            Mail::to($alumno->email)->send(new BienvenidaAlumnoMail($alumno));

            return ApiResponse::success($alumno, 'Alumno creado exitosamente', 201);
        }catch(\Exception $e){
            return ApiResponse::error('Error al crear el alumno', ['exception' => $e->getMessage()], 500);
        }
    }
    public function show(Alumno $alumno)
    {
        try{
            return ApiResponse::success($alumno, 'Alumno', 201);
        }catch(\Exception $e){
            return ApiResponse::error('Error al obtener el alumno', ['exception' => $e->getMessage()], 500);
        }
    }
    public function obtenerAlumno(string $matricula)
    {
        try{
            $alumno = Alumno::where('matricula','=',$matricula)->first();

            $alumno->load('sede');

            if(!$alumno){
                return ApiResponse::error('Alumno no encontrado', 'Alumno no encontrado: '.$matricula, 404);
            }
            return ApiResponse::success($alumno, 'Alumno', 201);
        }catch(\Exception $e){
            return ApiResponse::error('Error al obtener el alumno por matricula', ['exception' => $e->getMessage()], 500);
        }
    }
    public function update(UpdateAlumnoRequest $request, Alumno $alumno)
    {
        try{

            $alumno->update($request->validated());

            return ApiResponse::success($alumno, 'Alumno Actualizado Correctamente', 201);
        }catch(\Exception $e){
            return ApiResponse::error('Error al actualizar el alumno', ['exception' => $e->getMessage()], 500);
        }
    }
    public function destroy(Alumno $alumno)
    {
        try{
            if(!$alumno){
                return ApiResponse::error('Alumno no encontrado', 'Alumno no encontrado: '.$alumno, 404);
            }
            $alumno->delete();

            return ApiResponse::success(null, 'Alumno eliminado Correctamente', 201);
        }catch(\Exception $e){
            return ApiResponse::error('Error al elminiar alumno', ['exception' => $e->getMessage()], 500);
        }
    }
}
