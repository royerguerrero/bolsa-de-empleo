<?php
  require '../controllers/user.php';

  $usuarios = new Usuario();
  session_start();
  $array_usuarios = $usuarios->getUsuario($_SESSION['usuario']);

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

    <title>WorkPlace</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="<?php
            if($_SESSION['rol'] == 'Admin'){
              echo 'dash.php';
            }elseif ($_SESSION['rol'] == 'User') {
              echo 'home.php';
            }?>"
            >WorkPlace</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav ml-auto">
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
            <img src="<?php foreach ($array_usuarios as $row) {echo $row['imgUsuario'];}?>" alt="" class="rounded-circle shadow-lg bg-white rounded" width="200px" height="200px">
            <a href="#">
              <div class="edit-img text-center"><br>
                  <i data-feather="edit" class="mt-5"></i><br>
                  Cambiar
              </div>
            </a>
          </div>
        </section>
        <div class="container px-5">
          <br><br><br><br>
          <h2>Tu Informacion</h2>
          <div>
            <form class="" action="../controllers/user.php?action=cambiarImagen&cuenta=<?php foreach ($array_usuarios as $row) {echo $row['emailUsuario'];}?>" method="post" enctype="multipart/form-data">
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload">
                  <label class="custom-file-label" for="img-upload" aria-describedby="img-upload">Cambiar imagen</label>
                </div>
                <div class="input-group-append">
                  <input type="submit" name="submit" class="input-group-text" id="img-upload" value="Subir imagen">
                </div>
              </div>
            </form>
            <form method="post" action="../controllers/user.php?action=actualizarUsuario&cuenta=<?php foreach ($array_usuarios as $row) {echo $row['emailUsuario'];}?>"><br>
                <?php
                if(isset($_GET['mensaje'])){
                  echo '<div class="alert alert-danger alert-dismissible fade show w-75" role="alert">' . " <strong>Oh no! </strong>"
                  . $_GET['mensaje'] .
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
                }
                ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputnombre">Nombre</label>
                        <input type="text" class="form-control" id="inputnombre" placeholder="Nombre"
                            name="nombre" value="<?php foreach ($array_usuarios as $row) {echo $row['nombreUsuario'];}?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputApellido">Apellido</label>
                        <input type="text" class="form-control" id="inputApellido" placeholder="Apellido" name="apellido" value="<?php foreach ($array_usuarios as $row) {echo $row['apellidosUsuario'];}?>">
                    </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-9">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="ejemplo@mail.com" name="email" value="<?php foreach ($array_usuarios as $row) {echo $row['emailUsuario'];}?>">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputEdad">Edad</label>
                    <input type="number" class="form-control" id="inputEdad" placeholder="13" name="edad" min="13" max="200" value="<?php foreach ($array_usuarios as $row) {echo $row['Edad'];}?>">
                  </div>
                </div>
                <div class="form-group">
                    <label for="inputContraseña">Contraseña</label>
                    <input type="password" class="form-control" id="inputContraseña" placeholder="Pon tu nueva Contraseña" name="pass" value="<?php foreach ($array_usuarios as $row) {echo $row['passUsuario'];}?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputTelefono">Telefono</label>
                        <input type="tel" class="form-control" id="inputTelefono" name="tel" placeholder="+57 COLOMBIA" value="<?php foreach ($array_usuarios as $row) {echo $row['telefonoUsuario'];}?>">
                    </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputProfesion">Profesion</label>
                    <input type="text" id="inputProfesion" class="form-control" name="profesion" value="<?php foreach ($array_usuarios as $row) {echo $row['profesion'];}?>">
                    <?php
                      echo $_SESSION['rol']
                    ?>
                  </div>
                  <div class="form-group col-md-6">
                        <label for="text-area">Perfil Profesional</label>
                        <textarea class="form-control" id="text-area" rows="5" name="pro-perfil" ><?php foreach ($array_usuarios as $row) {echo $row['descripcionUsuario'];}?></textarea>
                  </div>
                </div>

                <br><br>

                <input type="submit" class="btn btn-warning m-auto" value="Editar"></input>
                <a href="../controllers/user.php?action=eliminarCuenta&cuenta=<?php foreach ($array_usuarios as $row) {echo $row['emailUsuario'];}?>" class="btn btn-danger mx-2"><i data-feather="x-circle"></i> Eliminar Cuenta</a>
            </form>
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
