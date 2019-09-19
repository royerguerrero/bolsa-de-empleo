<?php
  require '../controllers/profesiones.php';

  $profesiones = new Profesiones();

  $array_tipoProfesiones = $profesiones->getTipoProfesion();

  $array_roles = $profesiones->getRoles();

?>
<!doctype html>
<html lang="es">

<head>
    <!-- required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css"><link rel="shortcut icon" href="../public/img/favicon.ico">

    <title>WorkPlace</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="../public/landing.php">WorkPlace</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../public/landing.php">Inicio <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Caracteristicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Precios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary active px-4" href="registro.php">Registarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary text-dark px-4" href="ingreso.php">Ingresar</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 banner-reg">
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <form method="post" action="../controllers/user.php?action=registrarUsuario"><br>
                            <h1 class="text-center">📲 Registro 💻</h1><br>
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
                                        name="nombre" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputApellido">Apellido</label>
                                    <input type="text" class="form-control" id="inputApellido" placeholder="Apellido" name="apellido" required>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-9">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" placeholder="ejemplo@mail.com" name="email" required>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="inputEdad">Edad</label>
                                <input type="number" class="form-control" id="inputEdad" placeholder="13" name="edad" min="13" max="200" required>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="inputContraseña">Contraseña</label>
                                <input type="password" class="form-control" id="inputContraseña" placeholder="•••••••••••" name="pass" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputTelefono">Telefono</label>
                                    <input type="tel" class="form-control" id="inputTelefono" name="tel" placeholder="+57 COLOMBIA" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputTipoDeProfesion">Tipo de Profesion</label>
                                    <select id="inputTipoDeProfesion" class="form-control" name="tipoProfesion" required>
                                        <option selected>Elegir...</option>
                                        <?php
                                        foreach ($array_tipoProfesiones as $row) {
                                          echo '<option value="'. $row['idTipoProfesion'] .'">'. $row['nombreTipoProfesion'] .'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputProfesion">Profesion</label>
                                <input type="text" id="inputProfesion" class="form-control" name="profesion" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="inputRol">Rol</label>
                                <select id="inputRol" class="form-control" name="rol" required>
                                  <option selected>Elegir...</option>
                                  <?php
                                  foreach ($array_roles as $row) {
                                    echo '<option value="'. $row['idRol'] .'">'. $row['nombreRol'] .'</option>';
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <label>Años de experiencia</label>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="experiencia" id="inlineRadio1" value="0">
                              <label class="form-check-label" for="inlineRadio1" required>Ninguna</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="experiencia" id="inlineRadio2" value="1">
                              <label class="form-check-label" for="inlineRadio2">Menos de un año</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="experiencia" id="inlineRadio3" value="2">
                              <label class="form-check-label" for="inlineRadio3">Mas de un año</label>
                            </div><br>

                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" required>
                              <label class="form-check-label" for="inlineCheckbox1">Acepto Terminos y condiciones</label>
                            </div>
                            <br><br>

                            <input type="submit" class="btn btn-primary m-auto" value="Enviar"></input>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
