<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
</head>
<body>
<h1>¡Hola {{ $alumno->nombre }}!</h1>
<p>Bienvenido(a) a la institución.</p>
<p>Tu matrícula asignada es: <strong>{{ $alumno->matricula }}</strong></p>
</body>
</html>
