<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/publisStyles.css">
    <link rel="stylesheet" href="../styles/modalCrearPublicacion.css">
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
    <div id="create-publi_form" class="divCardCrearPubli">
      <div class="imgDivCrearPubli">
      <img class="centralSideImageImage" src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt="">
      </div>
      <div class="ipDivCrearPubli">
      <input type="text" placeholder="Haz una publicación">
      </div>


    </div>

    <div class="publisSection">
      <div class="publiCard">
        <div class="datosPubli">
          <div class="fotoDatosPubli"><img src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt=""></div>
          <div class="datosDatosPubli">
            <h1>Janice Griffith</h1>
            <p>Published: June,2 2018 19:PM</p>
          </div>
          </div>
          <div class="descriptionPublicacion">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis beatae, ipsum sunt aliquam quasi magni ullam tenetur officia consequuntur. Odit officiis ex a ipsam ab esse nihil quia voluptates.</p>
          </div>
          <div class="fotoPubliPrincipal">
            <img class="imagenPublicacionPrincipal" src="https://webunwto.s3.eu-west-1.amazonaws.com/2021-01/un-general-assembly.jpg?VersionId=WCBuWMPVkL.WYPHiNRQP2lHM3.AhwcKv" alt="">
          </div>

          <div class="reaccionesPubliBar">
              <li><img src="../img/reaction-icons/001-como.png" alt="">10</li>
              <li><img src="../img/reaction-icons/002-no-me-gusta.png" alt="">550</li>
              <li><img src="../img/reaction-icons/003-comentario-positivo.png" alt="">100</li>
            </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="rigthSide">

  </div>

  <dialog class="dialogCrearPubli" id="favDialog">
    <form method="dialog">
    <section>
      <div class="cerrarDialog">
        <div class="h1crearPuDiv">
        <h1>Crea una publicación</h1>
        </div>

        <button id="cancel" type="reset">X</button>
      </div>

        <div class="datosUserPublicacion">
          <div class="imagenUserPubliNueva"><img src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt=""></div>
          <div class="usernameName">
            <h3>Joseph Joestar</h3>
          </div>

        </div>

        
        <div class="textPublicacion">
            <textarea placeholder="¿Que estas pensando?" name="" id="" cols="30" rows="10"></textarea>
          </div>

          <div class="imagesPubli">
            <div class="addFotoPublicacion">+</div>
            <div class="imagesPubliCargadas"><img src="https://cnnespanol.cnn.com/wp-content/uploads/2022/09/GettyImages-1235399686.jpg?quality=100&strip=info" alt=""></div>
          </div>

          <div class="btn_publicar">
            <button>Publicar</button>
          </div>
    </section>
    </form>
  </dialog>


  </div>
</div>

  <script>
      (function () {
    var publiButton = document.getElementById("create-publi_form");
    var cancelButton = document.getElementById("cancel");
    var favDialog = document.getElementById("favDialog");

    // Update button opens a modal dialog
    publiButton.addEventListener("click", function () {
      favDialog.showModal();
      document.body.classList.add("bloquear-scroll");
    });

    // Form cancel button closes the dialog box
    cancelButton.addEventListener("click", function () {
      favDialog.close();
      document.body.classList.remove("bloquear-scroll");
    });
  })();
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>