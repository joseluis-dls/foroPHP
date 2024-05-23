<?php 
require_once("../connection.php");
session_start(); 
$user = $_SESSION["username"];

// Consulta preparada para prevenir inyección SQL 
$query = mysqli_prepare($connection, "SELECT * FROM users WHERE username = ? AND deleted_at IS NULL;");
mysqli_stmt_bind_param($query, "s", $user);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

$message = "Comment succesfully added";

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $profile_photo = $data["profile_photo"];
} else {
    echo "No se encontró el usuario";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../styles/publisStyles.css">
  <link rel="stylesheet" href="../styles/modalCrearPublicacion.css">
  <link rel="stylesheet" href="../styles/modalAccept.css">
  <link rel="stylesheet" href="../styles/comments.css">
  <link rel="stylesheet" href="../styles/imagenAmpliada.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="box-shadow: 5px -9px 20px 8px rgba(0, 0, 0, 0.3);">
    <div class="container-fluid">
      <!-- Columna izquierda: logo o título -->
      <div class="col-md-4">
        <img src="../img/logo.png" class="navbar-brand me-3" style="width: 23%;" href="#"></img>
      </div>

      <!-- Columna central: buscador -->
      <div class="col-md-4 text-center">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>

      <!-- Columna derecha: iconos de notificaciones, configuración y cerrar sesión -->
      <div class="col-md-4 text-end">
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item me-3">
            <a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
              </svg></a>
          </li>
          <?php if ($_SESSION["rol_id"] == "1"): ?>
          <li class="nav-item me-3 li-Navbar_animacion">
            <a class="nav-link" href="adminDashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
              </svg></a>
          </li>
          <?php endif; ?>
          <li class="me-3 nav-item li-Navbar_animacion">
            <a class="nav-link" href="../exit.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
              </svg></a>
          </li>
        </ul>
      </div>
  </nav>

  <div class="section_publis">
    <div class="leftSide">
      <div class="divLeftSidePresentation">
        <div class="imgPresntacionLeft"><img src="<?php echo $profile_photo;?>" alt=""></div>
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
          <img class="centralSideImageImage" src="<?php echo $profile_photo; ?>" alt="">
        </div>
        <div class="ipDivCrearPubli">
          <input type="text" placeholder="Haz una publicación">
        </div>
      </div>

      <div class="publisSection" id="publisSection">
        <!-- Posts -->
      </div>
    </div>

    <div class="rightSide">
      <div class="statsProfile">
        <h3>P E R F I L</h3>
        <div class="underlineH1"></div>
        <div class="dataUserRightSide">
          <p>Número de Publicaciones: <span>24</span></p>
          <p>Número de Me Gusta: <span>230</span></p>
        </div>
      </div>
    </div>
  </div>

  <script src="../script.js"></script>
  <script src="../comments.js"></script>
  <script src="../imagenAmpliada.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoZlA6LCrjQ8t1GniyPxyHq7lG2Kp6O8AM+SKuM5tt+0Mxd" crossorigin="anonymous"></script>
</body>

</html>
