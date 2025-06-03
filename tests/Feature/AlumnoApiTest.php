<?php

namespace Tests\Feature;

use App\Models\Alumno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlumnoApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void{
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_crear_un_alumno()
    {
        $data = [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'apellido_materno' => 'Gómez',
            'email' => 'juan@example.com',
            'sede_id' => 1,
        ];

        $response = $this->postJson('/api/alumnos', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Alumno creado exitosamente',
                'data' => [
                    'nombre' => 'Juan',
                    'email' => 'juan@example.com',
                ]
            ]);

        $this->assertDatabaseHas('alumnos', ['email' => 'juan@example.com']);
    }

    public function test_listar_alumnos()
    {
        //Alumno::factory()->count(3)->create();

        $response = $this->getJson('/api/alumnos');

        $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'listado de Alumnos',
        ])
            ->assertJsonCount(10, 'data');
    }

    public function test_mostrar_un_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->getJson("/api/alumnos/{$alumno->id}");

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Alumno',
                'data' => [
                    'id' => $alumno->id,
                    'email' => $alumno->email,
                ]
            ]);
    }

    public function test_actualizar_un_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->putJson("/api/alumnos/{$alumno->id}", [
            'nombre' => 'Nuevo Nombre',
            'apellido' => $alumno->apellido,
            'apellido_materno' => $alumno->apellido_materno,
            'email' => $alumno->email,
            'sede_id' => $alumno->sede_id,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Alumno Actualizado Correctamente',
                'data' => [
                    'nombre' => 'Nuevo Nombre',
                ]
            ]);

        $this->assertDatabaseHas('alumnos', ['id' => $alumno->id, 'nombre' => 'Nuevo Nombre']);
    }

    public function test_eliminar_un_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->deleteJson("/api/alumnos/{$alumno->id}");

        $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'Alumno eliminado Correctamente',
        ]);

        $this->assertSoftDeleted('alumnos', ['id' => $alumno->id]);
    }

    public function test_obtener_alumno_por_matricula()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->getJson("/api/alumnos/{$alumno->matricula}/get");

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Alumno',
                'data' => [
                    'matricula' => $alumno->matricula,
                    'email' => $alumno->email,
                ]
            ]);
    }
}
