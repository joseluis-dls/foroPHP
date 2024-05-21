    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="../styles/adminDashboard.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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





        <section class="container-lol">
            <article class="elemento" onclick="toUsers()">Administrar Usuarios<i class=" fa-solid fa-house-user"></i></article>
            <article class="elemento" onclick="toReports()">Reportes<i class=" fa-solid fa-users-slash"></i></article>
            <article class="elemento">Feed<i class=" fa-solid fa-users"></i></article>
            <article class="elemento-info user">

                <canvas id="graficaUser" width="400" height="300"></canvas>

            </article>


            <article class="elemento-info reportes">
                <div>
                    <p>500</p>
                    <p>Reportes pendientes</p>
                </div>
            </article>
            <article class="elemento-info post">
                <div class="canvas-container">
                    <canvas id="graficaPost" width="200" height="100"></canvas>

                </div>
                <p>Información extra de esta grafica</p>
            </article>
        </section>
    </body>
    <script>
        let chartUser = document.getElementById("graficaUser").getContext('2d')
        let charPost = document.getElementById("graficaPost").getContext('2d')
        var chart = new Chart(chartUser, {
            type: "bar",
            data: {
                labels: ["Diario", "Semanal", "Mensual", "Semestral"],
                datasets: [{
                    label: "Usuarios Registrados",
                    backgroundColor: "rgb(0,0,0)",
                    data: [12, 39, 5, 30]
                }]
            }
        });

        var chart = new Chart(charPost, {
            type: "pie",
            data: {
                labels: ['Hambre Cero', 'Fin De La Pobreza', 'Salud Y Bienestar'],
                datasets: [{
                    data: [30, 40, 30], // Tamaños de las porciones
                    backgroundColor: ['#910A67', '#3C0753', '#8F43EE'] // Colores de las porciones
                }]
            }
        })

        function toUsers() {
            // Cambia "pagina_destino.html" por la URL de la página a la que deseas redirigir al usuario
            window.location.href = "adminUsers.php";
        }

        function toReports() {
            // Cambia "pagina_destino.html" por la URL de la página a la que deseas redirigir al usuario
            window.location.href = "adminReports.php";
        }
    </script>
    <script src="https://kit.fontawesome.com/c30a6641b2.js" crossorigin="anonymous"></script>
    <script src="../js/app.js"></script>

    </html>