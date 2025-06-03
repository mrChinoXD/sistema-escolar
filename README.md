# Proyecto Sistema Escolar - Laravel 12

Este proyecto es una API REST desarrollada con **Laravel 12** que permite gestionar alumnos y sus sedes. Incluye CRUD completo, validaciones, envío de correos de bienvenida y respuestas JSON estandarizadas.

---

## ⚙️ Requisitos

- PHP 8.2 o superior
- Composer
- SQLite (instalado por defecto en la mayoría de entornos)
- Mailtrap (para pruebas de envío de correo)

---

## 🚀 Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/mrChinoXD/sistema-escolar.git
   cd sistema-escolar
   ```

2. Instala las dependencias:
   ```bash
   composer install
   ```

3. Copia el archivo de entorno:
   ```bash
   cp .env.example .env
   ```

4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

5. Configura la base de datos SQLite:

    - Crea un archivo vacío para SQLite:
      ```bash
      touch database/database.sqlite
      ```

    - En tu `.env`, asegúrate de tener:
      ```
      DB_CONNECTION=sqlite
      DB_DATABASE=${PWD}/database/database.sqlite
      ```

6. Ejecuta migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

---

## 📫 Configuración de Correo (Mailtrap)

Edita el archivo `.env` con tus credenciales reales de Mailtrap:

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu_usuario_mailtrap
MAIL_PASSWORD=tu_contraseña_mailtrap
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@tusistema.com
MAIL_FROM_NAME="Sistema Escolar"
```

> Puedes obtener estas credenciales en https://mailtrap.io

---

## 🧪 Ejecutar Tests

Este proyecto incluye tests de integración para todas las rutas API.

```bash
php artisan test
```

> Los tests usan SQLite automáticamente (`RefreshDatabase`).

---

## 📡 Endpoints API

Puedes importar los endpoints en **Insomnia** usando el archivo `Insomnia_Collection.yaml` incluido en la raíz del proyecto.

### Rutas principales:

| Método | Ruta                          | Descripción                        |
|--------|-------------------------------|------------------------------------|
| GET    | /api/alumnos                  | Listar alumnos                     |
| GET    | /api/alumnos/{id}             | Mostrar alumno por ID              |
| GET    | /api/alumnos/{matricula}/get  | Buscar alumno por matrícula        |
| POST   | /api/alumnos                  | Crear nuevo alumno                 |
| PUT    | /api/alumnos/{id}             | Actualizar alumno                  |
| DELETE | /api/alumnos/{id}             | Eliminar alumno (soft delete)      |

---

## 📦 Estructura relevante

```
├── app/
│   ├── Http/
│   │   ├── Controllers/AlumnoController.php
│   │   ├── Requests/CreateAlumnoRequest.php
│   │   ├── Requests/UpdateAlumnoRequest.php
│   │   └── Responses/ApiResponse.php
│   ├── Mail/BienvenidaAlumnoMail.php  
│   ├── Traits/GeneraMatricula.php  
├── routes/api.php
├── tests/Feature/AlumnoApiTest.php
├── database/database.sqlite
├── Insomnia_Collection.yaml
└── README.md
```

---

## 💬 Notas

- Este proyecto usa **soft deletes** para el modelo `Alumno`.
- El envío de correo se activa automáticamente al crear un alumno nuevo.
- Todas las respuestas JSON están estandarizadas con `ApiResponse`.
