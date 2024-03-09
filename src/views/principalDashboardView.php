<?php session_start();?>
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

<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="    box-shadow: 5px -9px 20px 8px rgba(0, 0, 0, 0.3);">
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
        <li class="nav-item me-3 " >
          <a class="nav-link " href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
</svg></a>
        </li>
        <li class="nav-item me-3 li-Navbar_animacion">
          <a class="nav-link" href="adminDashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
</svg></a>
        </li>
        <li class="me-3 nav-item li-Navbar_animacion">
          <a class="nav-link" href="../exit.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="section_publis">
    <div class="leftSide">
      <div class="divLeftSidePresentation">
        <div class="imgPresntacionLeft"><img src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt=""></div>
        <div class="usernamePresentacionLeft"><h1><?php echo $_SESSION["username"]?></h1></div>
      </div>
    </div>

    <div class="centralSide">
      <div id="create-publi_form" class="divCardCrearPubli">
        <div class="imgDivCrearPubli">
          <img class="centralSideImageImage" src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt="">
        </div>
        <div class="ipDivCrearPubli">
          <input type="text" placeholder="Haz una publicación" >
        </div>


      </div>

      <div class="publisSection" id="publisSection">
        <!-- Posts -->
      </div>
    </div>

    <div class="rigthSide">

    </div>

    <dialog class="dialogCrearPubli" id="favDialog">
      <form method="post" id="createPost">
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
              <h3><?php echo $_SESSION['username']?></h3>
            </div>

        
        <div class="textPublicacion">
            <textarea placeholder="¿Que estas pensando?" name="post_content" id="post_content" cols="10" rows="10"></textarea>
          </div>

          <div class="imagesPubli">
              <input type="file" name="post_picture" id="post_picture">
              <div class="imagesPubliCargadas"><img src="https://cnnespanol.cnn.com/wp-content/uploads/2022/09/GettyImages-1235399686.jpg?quality=100&strip=info" alt=""></div>
          </div>

          <div class="btn_publicar">
            <button id="btnCreatePost">Publicar</button>
          </div>
        </section>
      </form>
    </dialog>


  </div>
  </div>

<script src="../js/jquery.js"></script>
  <script>
    (function() {
      var publiButton = document.getElementById("create-publi_form");
      var cancelButton = document.getElementById("cancel");
      var favDialog = document.getElementById("favDialog");

      // Update button opens a modal dialog
      publiButton.addEventListener("click", function() {
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

<script>
$(document).ready(function () {

  async function getPosts() {
    $.ajax({
      type: "get",
      url: "../php/getPosts.php",
      success: await function (response) {
        let posts = JSON.parse(response);
        let template = ''

        if (posts.length > 0) {
          // Itera sobre los posts obtenidos para mostrarlos en pantalla
          posts.forEach( post => {
            template += `
                <div class="publiCard">
                  <div class="datosPubli">
                    <div class="fotoDatosPubli"><img src="https://b2472105.smushcdn.com/2472105/wp-content/uploads/2023/01/Perfil-Profesional-_63-819x1024.jpg?lossy=1&strip=1&webp=1" alt=""></div>
                    <div class="datosDatosPubli">
                      <h1>${post.username}</h1>
                      <p>Published: ${post.posted_at}</p>
                    </div>
                    </div>
                    <div class="descriptionPublicacion">
                      <p>${post.post_content}</p>
                    </div>
                    <div class="fotoPubliPrincipal">
                      <img class="imagenPublicacionPrincipal" src="${post.post_picture}" alt="">
                    </div>

                    <div class="reaccionesPubliBar">
                        <li><img src="../img/reaction-icons/001-como.png" alt="">10</li>
                        <li><img src="../img/reaction-icons/002-no-me-gusta.png" alt="">550</li>
                        <li><img src="../img/reaction-icons/003-comentario-positivo.png" alt="">100</li>
                      </ul>
                  </div>
                </div>
            `
          })

          $("#publisSection").html(template);
        }
      },
      error: error => {
        console.error(error)
      }
    });
  }
  getPosts();

  $("#btnCreatePost").click(function (e) { 
    e.preventDefault();
    let formData = new FormData($("#createPost")[0]);

    $.ajax({
      type: "post",
      url: "../php/uploadPost.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response)
      },
      error: function (error) {
        console.error(error)
      }
    });

    getPosts()

    
  });

  getPosts();

});
  
</script>
</body>

</html>