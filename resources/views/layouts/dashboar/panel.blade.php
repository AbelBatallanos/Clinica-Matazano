
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel - Clínica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background-color: #0d6efd; min-height: 100vh; color: white; }
        .sidebar a { color: white; padding: 10px 20px; display: block; text-decoration: none; }
        .sidebar a:hover { background-color: #0b5ed7; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar d-flex flex-column p-3">
        <h4>Clínica</h4>
        <a href="{{ route("home") }}"><i class="bi bi-house"></i> Inicio</a>
        <a href="{{ route("listUsuarios")}}"><i class="bi bi-people"></i> Pacientes</a>
        <a href="{{ route("crearCita") }}"><i class="bi bi-calendar-check"></i> Reservas</a>
        <a href="{{ route("VerHistorialClinico") }}"><i class="bi bi-journal-medical"></i> Historiales</a>
    <hr class="bg-white">
    <div class="mt-auto pt-4">
    <div class="dropdown">
        <a href="#" class="d-block text-white text-decoration-none dropdown-toggle" id="perfilDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> Mi Cuenta
        </a>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="perfilDropdown">
            <li><a class="dropdown-item" href=""><i class="bi bi-person"></i> Ver Perfil</a></li>
            <li><a class="dropdown-item" href=""><i class="bi bi-pencil-square"></i> Editar Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route("logout") }}">
                    @csrf
                    <button class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </div>
</div>

    </div>
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
