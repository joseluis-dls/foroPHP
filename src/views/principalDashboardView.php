<?php 
require_once("../connection.php");
session_start(); 
$user = $_SESSION["username"];

// Consulta preparada para prevenir inyección SQL 
$query = mysqli_prepare($connection, "SELECT * FROM users WHERE username = ? AND deleted_at IS NULL;");
mysqli_stmt_bind_param($query, "s", $user);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    $profile_photo = $data["profile_photo"];
  
} else {
  echo "No se encontró el user";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/publisStyles.css">
  <link rel="stylesheet" href="../styles/modalCrearPublicacion.css">
  <link rel="stylesheet" href="../styles/modalAccept.css">
  <link rel="stylesheet" href="../styles/comments.css">
  <link rel="stylesheet" href="../styles/imagenAmpliada.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top"
    style="    box-shadow: 5px -9px 20px 8px rgba(0, 0, 0, 0.3);">
    <div class="container-fluid">
      <!-- Columna izquierda: logo o título -->
      <div class="col-md-4">
        <img src="../img/logo.png" class="navbar-brand me-3" style="width: 23%;" href="#"></img>
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
          <li class="nav-item me-3 ">
            <a class="nav-link " href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                <path
                  d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
              </svg></a>
          </li>
          <?php 
            if ($_SESSION["rol_id"] == "1"){

          ?>
              <li class="nav-item me-3 li-Navbar_animacion">
                <a class="nav-link" href="adminDashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path
                      d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                  </svg></a>
              </li>
          <?php 
            
            } else {

            }
          
          ?>



          <li class="me-3 nav-item li-Navbar_animacion">
            <a class="nav-link" href="../exit.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                <path fill-rule="evenodd"
                  d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
              </svg></a>
          </li>
        </ul>
      </div>
  </nav>

  <div class="section_publis">
    <div class="leftSide">
      <div class="divLeftSidePresentation">
        <div class="imgPresntacionLeft"><img
            src="<?php  echo $profile_photo;?>"
            alt=""></div>
        <div class="usernamePresentacionLeft">
          <h1>
            <a href=""><?php echo $_SESSION["username"] ?></a>
          </h1>
        </div>
      </div>

      <div class="filtrosPublis">
        <div class="filtrosNameH1">
          <h1>F I L T R O S</h1>
          <div class="underlineH1"></div>
        </div>

        <div class="filtroBotones">
          <div class="odsLogo">
            <img src="../img/ODS_1.jpg" alt="">
          </div>
          <div class="odsLogo">
            <img src="../img/ODS_2.jpg" alt="">
          </div>
          <div class="odsLogo">
            <img src="../img/ODS_3.png" alt="">
          </div>
        </div>

      </div>
    </div>

    <div class="centralSide">
      <div id="create-publi_form" class="divCardCrearPubli">
        <div class="imgDivCrearPubli">
          <img class="centralSideImageImage"
            src="<?php echo $profile_photo; ?>"
            alt="">
        </div>
        <div class="ipDivCrearPubli">
          <input type="text" placeholder="Haz una publicación">
        </div>


      </div>

      <div class="publisSection" id="publisSection">
        <!-- Posts -->
      </div>
    </div>

    <div class="rigthSide">
      <div class="statsProfile">
        <h3>P E R F I L</h3>
        <div class="linePerfilProfile"></div>
        <div class="infoPerfilCard">
          <div class="imgInfoCardProfile"><img src="<?php echo $profile_photo; ?>" alt="profile_photo"></div>
          <div class="textInfoCardProfile">
            <h2> <?php echo $_SESSION['username']; ?></h2>
            <ul>
              <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-postcard-heart" viewBox="0 0 16 16">
                  <path
                    d="M8 4.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622M2.5 5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                  <path fill-rule="evenodd"
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" />
                </svg>
                <span id="likesCount">13 Me gusta</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="btnsCardInfoPerfil">
          <button onclick="showLikes()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chat-square-heart"
              viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
              <path d="M8 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
            </svg>
          </button>
          <button onclick="showComments()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chat-left-text"
              viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
              <path
                d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
            </svg>
          </button>
        </div>
        <div class="ipStatsProfile" id="likes" style="display: none;">
          <h2>Tus publicaciones suman</h2>
          <p> <span class="iconCorazon"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                <path
                  d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
              </svg></span>13</p>

          <h3>2 likes nuevos esta semana</h3>
        </div>

        <div class="ipStatsProfile" id="comments" style="display: none;">
          <h2>Tus publicaciones suman</h2>
          <p style="color:rgb(47, 19, 103); " class="commentP"><span style="padding-right:3%;"><svg
                xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="rgb(47, 19, 103)"
                class="bi bi-chat-right-dots-fill" viewBox="0 0 16 16">
                <path
                  d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353zM5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
              </svg></span>20</p>

          <h3>10 comentarios nuevos esta semana</h3>
        </div>
      </div>



    </div>



  </div>

  <dialog class="dialogCrearPubli" id="favDialog">
    <form  id="createPost">
      <section>
        <div class="cerrarDialog">
          <div class="h1crearPuDiv">
            <h1>Crea una publicación</h1>
          </div>

          <button id="cancel" type="reset">X</button>
        </div>

        <div class="datosUserPublicacion">
          <div class="imagenUserPubliNueva"><img
              src="<?php echo $profile_photo; ?>"
              alt=""></div>
          <div class="usernameName">
            <h3>
              <?php echo $_SESSION['username'] ?>
            </h3>
          </div>

        </div>




        <div class="textPublicacion">
            <select style="width: 35%;
    background: transparent;
    border-top: none;
    border-right: none;
    border-left: none;
    padding-bottom: 1%;" name="" id="">
              <option value="FP">Fin de la pobreza</option>
              <option value="HC">Hambre Cero</option>
              <option value="SB">Salud y bienestar</option>
            </select>
          <textarea placeholder="¿Que estas pensando?" name="post_content" id="post_content" cols="30"
            rows="10"></textarea>
        </div>

        <div class="imagesPubli">
          <label for="post_picture" class="custom-file-upload">
            <input type="file" name="post_picture" id="post_picture" style="display: none;">
            <div class="plus-sign">+</div>
          </label>
          <div class="imagesPubliCargadas"><img id="preview_image"
              src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg"
              alt=""></div>
        </div>
        <div class="btn_publicar">
          <button id="btn_publicar">Publicar</button>
        </div>
      </section>
    </form>
  </dialog>


  </div>

  <div id="myModal"  class="modal">
  <div class="modal-content" style="margin-top:20%;">
    <p style="text-align:center; font-size:17px;">El post se ha publicado correctamente.</p>
    <button id="reloadPage">Aceptar</button>
  </div>
  </div>

  <div id="imagenAmpliada" class="imagen-ampliada">
  <span class="cerrar-imagen">&times;</span>
  <img id="imagenAmpliadaSrc" class="imagen-ampliada-src" src="" alt="">

  <script src="../js/jquery.js"></script>
  <script>
    (function () {
      var publiButton = document.getElementById("create-publi_form");
      var cancelButton = document.getElementById("cancel");
      var favDialog = document.getElementById("favDialog");
      var btn_publicar = document.getElementById("btn_publicar");

      publiButton.addEventListener("click", function () {
        favDialog.showModal();
        document.body.classList.add("bloquear-scroll");
      });

      cancelButton.addEventListener("click", function () {
        favDialog.close();
        document.body.classList.remove("bloquear-scroll");
      });

      btn_publicar.addEventListener("click", () => {
        document.body.classList.remove("bloquear-scroll");
      })

      document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
          document.body.classList.remove("bloquear-scroll");
        }
      });
    })();

    function showLikes() {
      var likesDiv = document.getElementById("likes");
      var commentsDiv = document.getElementById("comments");

      likesDiv.style.display = "block";
      commentsDiv.style.display = "none";
    }

    function showComments() {
      var likesDiv = document.getElementById("likes");
      var commentsDiv = document.getElementById("comments");

      likesDiv.style.display = "none";
      commentsDiv.style.display = "block";
    }

    document.getElementById('post_picture').addEventListener('change', function (event) {
      var reader = new FileReader();
      reader.onload = function () {
        var output = document.getElementById('preview_image');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    });

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
  </script>

  <script>
    

    $(document).ready(function () {
      $("#imagenAmpliada").hide();
      
      async function getPosts() {
        $.ajax({
          type: "get",
          url: "../php/getPosts.php",
          success: await function (response) {
            let posts = JSON.parse(response);
            let template = ''
            console.log(posts)
            if (posts.length > 0) {
              // Itera sobre los posts obtenidos para mostrarlos en pantalla
              posts.forEach(post => {
                template += `
                  <div class="publiCard">
                `;
                if (post.session_id == post.user_id) {
                  template += `
                  <div class="datosPubli">
                      <div class="fotoDatosPubli"><img src="${post.profile_photo}" alt=""></div>
                      <div class="datosDatosPubli">
                        <h1>${post.username}</h1>
                        <p>Published: ${post.posted_at}</p>
                      </div>
<button id="btn_delete" class="btn_delete" data-post-id="${post.post_id}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>                    </div>
                    <div class="descriptionPublicacion">
                      <p>${post.post_content}</p>
                    </div>
                  `
                } else {
                  template += `
                  <div class="datosPubli">
                      <div class="fotoDatosPubli"><img src="${post.profile_photo}" alt=""></div>
                      <div class="datosDatosPubli">
                        <h1>${post.username}</h1>
                        <p>Published: ${post.posted_at}</p>
                          </div>
                        </div>
                        <div class="descriptionPublicacion">
                          <p>${post.post_content}</p>
                        </div>
                  `
                }

                // Verifica si hay una imagen para mostrar
                if (post.post_picture !== "/foroPHP/src/img/posts/") {
                  template += `
                    <div class="fotoPubliPrincipal">
                      <img class="imagenPublicacionPrincipal" src="${post.post_picture}" alt="">
                    </div>
                  `;
                }

                template += `
                  <div class="reaccionesPubliBar">
                    <ul style="display:flex;">
                      <li><img src="../img/reaction-icons/001-como.png" alt="">10</li>
                      <li><img src="../img/reaction-icons/002-no-me-gusta.png" alt="">550</li>
                      <li><img src="../img/reaction-icons/003-comentario-positivo.png" alt="">100</li>
                    </ul>
                  </div>
                  <div class="commentsDiv">
                    <img src="${post.profile_photo}"></img>
                    <input type="text" placeholder="Escribe un comentario"></input>
                    <button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-send" viewBox="0 0 16 16">
                      <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                    </svg></button>
                  </div>
                </div>
              `;
              })

              $("#publisSection").html(template);
              $("#imagenAmpliada").hide();
              // Agregar evento click para mostrar la imagen ampliada
              $(".imagenPublicacionPrincipal").click(function() {
                const imagenSrc = $(this).attr("src");
                $("#imagenAmpliadaSrc").attr("src", imagenSrc);
                $("#imagenAmpliada").show();
              });

              // Agregar evento click para cerrar la imagen ampliada
              $(".cerrar-imagen").click(function() {
                $("#imagenAmpliada").hide();
              });
            }
          },
          error: error => {
            console.error(error)
          }
        });
      }

      getPosts();

      let formSubmitted = false;

      

  $("#btn_publicar").click(function (e) {
      e.preventDefault();
      console.log("presionado")
      
      // Si el formulario ya se ha enviado, no hacer nada
      if (formSubmitted) {
          return;
      }
      
      formSubmitted = true; // Marcar el formulario como enviado
      
      let formData = new FormData($("#createPost")[0]);

      $.ajax({
          type: "post",
          url: "../php/uploadPost.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
              console.log(response);
              // $("#favDialog").css("display", "none")
              favDialog.close();
              document.body.classList.remove("bloquear-scroll");
              $("#myModal").css("display", "block");
              formSubmitted = false; // Restablecer el estado del formulario después de que se complete la solicitud AJAX
          },
          error: function (error) {
              console.error(error);
              formSubmitted = false; // Restablecer el estado del formulario en caso de error
          }
      });

  });

  $(".close").click(function() {
              $("#myModal").css("display", "none");
          });

          // Recargar la página cuando se haga clic en el botón Aceptar
          $("#reloadPage").click(function() {
              location.reload();
          });

      });

  $(document).on('click', '#btn_delete', function () {
      // Obtener el identificador del post
      let postId = $(this).data('post-id');
      let confirmDelete = confirm('¿Seguro que deseas borrar este post?');

      $.ajax({
        type: "POST",
        url: '../php/deletePost.php',
        data: { post_id: postId },
        success: function (response) {
          console.log("Post eliminado exitosamente");
          location.reload()
        },
        error: function (error) {
          console.error("Error al eliminar el post:", error);
        }
      });
    });
  </script>
</body>


</html>