<?php
  require '../controllers/user.php';

  $usuarios = new Usuario();
  session_start();
  $array_usuarios = $usuarios->getUsuario($_SESSION['usuario']);

  $array_allUsers = $usuarios->getAllUsers();
?>
<!doctype html>
<html lang="es">

<head>
    <!-- required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <title>WorkPlace</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">WorkPlace</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="dash.php"><i data-feather="users" width="15px" height="15px"></i>  Usuarios</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#"><i data-feather="user" width="15px" height="15px"></i> Mi Perfil</a>
                  </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary text-dark px-4" href="../controllers/user.php?action=cerrar">Salir</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="banner-user container-fluid shadow-lg p-3 mb-5 bg-white rounded">
          <div class="img-user-container">
            <img src="<?php foreach ($array_usuarios as $row) {
              echo $row['imgUsuario'];
            }?>" alt="" class="rounded-circle shadow-lg bg-white" width="200px" height="200px">
            <a href="editProfile.php">
              <div class="edit-img text-center"><br>
                  <i data-feather="edit" class="mt-5"></i><br>
                  Cambiar
              </div>
            </a>
          </div>
        </section>
        <div class="container">
          <br><br><br><br>
          <div class="container px-5">
            <h2>Tu Informacion</h2>
            <div class="ml-4 w-50 lead">
              <?php

              foreach($array_usuarios as $row) {
                echo 'Nombre: ' . $row['nombreUsuario'] . ' ' . $row['apellidosUsuario'] .'<br>';
                echo 'Email: ' . $row['emailUsuario'] . '<br>';
                echo 'Edad: ' . $row['edadUsuario'] . '<br>';
                echo 'Telefono: ' . $row['telefonoUsuario'] . '<br>';
                echo 'Profesion: ' . $row['profesion'] . '<br>';
                echo 'Experiencia: ' . $row['experienciaUsuario'] . '<br>';
                echo 'Perfil Profesional: ' . $row['descripcionUsuario'] . '<br>';
              }

              echo 'Rol: ' . $_SESSION['rol'] . '<br>';
              ?>
              <a href="editProfile.php" class="btn btn-warning"><i data-feather="edit"></i></a><a href="editProfile.php" class="btn btn-danger mx-2"><i data-feather="x-circle"></i></a>
            </div>
          </div><br>
          <h2 class="text-center">Usuarios</h2>
          <div class="row d-flex align-items-center justify-content-center">
            <?php
            foreach ($array_allUsers as $row) {
              echo '<div class="col-md-5 col-sm-12 card shadow-lg p-3 bg-white m-2">';
              echo '  <div class="card-body row">';
              echo '    <div class="col-4">';
              echo '      <img src="' . $row['imgUsuario'] . '" alt="" class="rounded-circle" width="150px" height="150px">';
              echo '    </div>';
              echo '    <div class="col-8 mt-3 pl-5">';
              echo '      <h3>'. $row['nombreUsuario'] . '</h3>';
              echo '      <p class="text-uppercase">'. $row['profesion'] .' - Tel: ' . $row['telefonoUsuario'] . '</p>';
              echo '      <a href="profile.php?user='. $row['emailUsuario'] .'" class="btn btn-success">Ver mas</a>';
              echo '    </div>';
              echo '  </div>';
              echo '</div>';
            }
            ?>
          </div>
        </div>
    </main>
    <footer class="bg-primary text-center p-3 mt-5">
      <p class="m-auto">
        Una produccion de Royer Guerrero
      </p>
    </footer>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous">
            </script>
            <script>
                feather.replace()
            </script>
</body>

</html>
