<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/publisStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="    box-shadow: -20px 40px 40px 10px rgba(0, 0, 0, 0.3);">
  <div class="container-fluid">
    <!-- Columna izquierda: logo o título -->
    <div class="col-md-4">
      <a class="navbar-brand" href="#">UNESforum</a>
    </div>

    <!-- Columna central: buscador -->
    <div class="col-md-4 text-center"> <!-- Agregado text-center -->
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>

    <!-- Columna derecha: iconos de notificaciones, configuración y cerrar sesión -->
    <div class="col-md-4 text-end">
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-bell">Notificaciones</i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-user-cog">Cuenta</i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../exit.php"><i class="fas fa-sign-out-alt">Cerrar Sesión</i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="section_publis">
  <div class="leftSide">
      <div class="divLeftSidePresentation">
        <div class="imgPresntacionLeft"><img src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt=""></div>
        <div class="usernamePresentacionLeft"><h1>User</h1></div>
      </div>
  </div>

  <div class="centralSide">
    <div class="divCardCrearPubli">
      <div class="imgDivCrearPubli">
      <img src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt="">
      </div>
      <div class="ipDivCrearPubli">
      <input type="text" placeholder="Haz una publicación">
      </div>


    </div>
  </div>

  <div class="rigthSide">

  </div>
</div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>