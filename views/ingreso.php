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
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
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
                    <div class="d-flex align-items-center justify-content-center h-100">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="d-flex align-items-center justify-content-center h-100">
                            <form class="form-signin text-center" method="post" action="../controllers/user.php?action=iniciarSession">
                                    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                                    <h1 class="h3 mb-3 font-weight-normal">📲 Ingresar 💻</h1>
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
                                    <label for="inputUser" class="sr-only">User</label>
                                    <input type="email" id="inputUser" class="form-control" placeholder="email" required autofocus name="emailLogin">
                                    <label for="inputPassword" class="sr-only">Contraseña</label>
                                    <input type="password" id="inputPassword" class="form-control" placeholder="••••••••••" required name="passLogin">
                                    <div class="checkbox mb-3">
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                    <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
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
