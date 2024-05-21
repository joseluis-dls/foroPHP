<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Reportes</title>
    <link rel="stylesheet" href="../styles/adminReports.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); height: 80px;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Centra el título -->
            <div class="navbar-brand">

                <div class="logo"><img src="../img/logo.png" alt=""></div>
            </div>

            <!-- Parte derecha con enlace a la cuenta y el icono de logout -->
            <div class="text-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="enlace_a_la_cuenta" style="text-decoration: none; font-size: 30px;">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../exit.php" style="text-decoration: none;font-size: 30px;margin-left: 10px;">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="contenedor">
        <table border="1">
            <thead>
                <tr>
                    <th>ID Reporte</th>
                    <th>Nombre Usuario</th>
                    <th>Nombre del Usuario que Reportó</th>
                    <th>Motivo del Reporte</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irían las filas de datos, puedes agregarlas dinámicamente o estáticamente según tus necesidades -->
                <tr>
                    <td>1</td>
                    <td>Usuario1</td>
                    <td>Reportador1</td>
                    <td>Motivo1</td>
                    <td>2024-03-07</td>
                    <td>
                        <button class="btn btn-primary">Ver Post</button>
                        <button class="btn btn-danger">Borrar Post</button>
                        <button class="btn btn-warning">Bloquear Usuario</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</body>
<script src="https://kit.fontawesome.com/c30a6641b2.js" crossorigin="anonymous"></script>
<script src="../js/app.js"></script>

</html>