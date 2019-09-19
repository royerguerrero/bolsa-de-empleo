<?php

  require '../models/conexion.php';

  class Usuario extends Conexion{

    public $usuario;

    public function Usuario(){
      parent::__construct();
    }

    public function getUsuario($user){

      $sql = "SELECT * FROM usuarios WHERE emailUsuario = '". $user ."'";
      $result = $this->conn->query($sql);

      $nombreUsuario = $result->fetch_all(MYSQLI_ASSOC);
      return $nombreUsuario;
    }

    public function getAllUsers(){
      $sql = "SELECT * FROM usuarios";
      $result = $this->conn->query($sql);

      $usuarios = $result->fetch_all(MYSQLI_ASSOC);
      return $usuarios;
    }


    public function registarUsuario(){

      $passHash = $_POST['pass'] . '-$d4sdf4r5f1dfrf1d8f';

      $sql = "INSERT INTO usuarios (idUsuario, nombreUsuario, apellidosUsuario, emailUsuario, edadUsuario, passUsuario, telefonoUsuario, imgUsuario, descripcionUsuario, idTipoProfesion, profesion, experienciaUsuario, idRol)
      VALUES (NULL, '". $_POST["nombre"] ."', '". $_POST["apellido"] ."', '". $_POST["email"] ."', '". $_POST["edad"] ."', '". $passHash ."', '". $_POST["tel"] ."', '../uploads/user-default.png', 'Escribe aqui tu perfil profesional', '". $_POST["tipoProfesion"] ."', '". $_POST["profesion"] ."', '". $_POST["experiencia"] ."', '". $_POST["rol"] ."');";

      if ($this->conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header('Location: ../views/ingreso.php');
      } else {
        header('Location: ../views/registro.php?mensaje=El usuario probablemente ya existe!!!');
        echo "Error: " . $sql . "<br>" . $this->conn->error;
      }

    }

    public function iniciarSession(){

        $passLogin = $_POST['passLogin'] . '-$d4sdf4r5f1dfrf1d8f';

        $sql = "SELECT emailUsuario, passUsuario, idRol FROM usuarios WHERE emailUsuario = '". $_POST["emailLogin"] ."' AND passUsuario = '". $passLogin ."'";
        $result = $this->conn->query($sql);


        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            session_start();
            $_SESSION['usuario'] = $row['emailUsuario'];
            if($row['idRol'] == 0){
              $_SESSION["rol"] = "Admin";
              header('Location: ../views/dash.php');
              echo "admin";
            }elseif ($row['idRol'] == 1) {
              $_SESSION["rol"] = "User";
              header('Location: ../views/home.php');
              echo "User";
            }else {
              header('Location: ../views/ingreso.php?mensaje=Lo sentimos, verifica el usuario o la contaseña e intente nuevamente');
            }
          }
        } else {
          header('Location: ../views/ingreso.php?mensaje=Lo sentimos, verifica el usuario o la contaseña e intente nuevamente');
          echo "0 results";
        }
    }


    public function cerrar(){
      session_start();
      unset ($SESSION['rol']);
      unset ($SESSION['usuario']);
      session_destroy();

      header('Location: ../public/landing.php');
    }

      public function eliminarCuenta(){
        echo "<script>confirm('Seguro que quieres eliminar tu cuenta')</script>";
            $sql = "DELETE FROM usuarios WHERE emailUsuario = '". $_GET["cuenta"] ."'";

            if ($this->conn->query($sql) === TRUE) {
              echo "Record deleted successfully";
              header('Location: ../public/landing.php');
            } else {
              header('Location: ../views/editProfile.php?mensaje=No se pudo borrar tu cuenta');
              echo "Error deleting record: " . $conn->error;
            }
      }

      public function actualizarUsuario(){
        $sql = "UPDATE usuarios SET nombreUsuario='". $_POST["nombre"] ."', apellidosUsuario='". $_POST["apellido"] ."', emailUsuario='". $_POST["email"] ."', edadUsuario='". $_POST["edad"] ."', passUsuario='". $_POST["pass"] ."', telefonoUsuario='". $_POST["tel"] ."', profesion='". $_POST["profesion"] ."', descripcionUsuario='". $_POST["pro-perfil"] ."'
        WHERE emailUsuario = '". $_GET["cuenta"] ."'";

        if ($this->conn->query($sql) === TRUE) {
          echo "Record updated successfully";
          session_start();
          if ($_SESSION['rol'] == 'Admin') {
            header('Location: ../views/dash.php');
          }elseif($_SESSION['rol'] == 'User'){
            header('Location: ../views/home.php');
          }

        } else {
          if ($_GET['rol'] == 0) {
            header('Location: ../views/editProfile.php?mensaje=La cuenta de correo que intentas usar ya esta en uso');
          }elseif($_GET['rol'] == 1){
            header('Location: ../views/editProfile.php?mensaje=La cuenta de correo que intentas usar ya esta en uso');
          }
          echo "Error updating record: " . $this->conn->error;
        }
      }
      public function cambiarImagen(){
        $target_dir = "../uploads/";
        date_default_timezone_set("America/Bogota");
        $target_file = $target_dir . "workplace-" . $_GET['cuenta'] . date("Y-m-d") . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            header('Location: ../views/editProfile.php?mensaje=No se pudo subir ti imagen, es posible que sea muy grande');

            $uploadOk = 0;
          }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
          header('Location: ../views/editProfile.php?mensaje=Lo sentimos el archivo es muy grande');
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
          header('Location: ../views/editProfile.php?mensaje=Lo sentimos el formato no se admite, debe ser una imegen');
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $sql = "UPDATE usuarios SET imgUsuario='../uploads/workplace-" . $_GET['cuenta'] . date("Y-m-d") .basename( $_FILES["fileToUpload"]["name"]) ."' WHERE emailUsuario='". $_GET['cuenta'] ."'";

            if ($this->conn->query($sql) === TRUE) {
              echo "Record updated successfully";
              header('Location: ../views/editProfile.php');
            } else {
              header('Location: ../views/editProfile.php?mensaje=Error al subir tu foto');
              echo "Error updating record: " . $this->conn->error;
            }
          } else {
            echo "Sorry, there was an error uploading your file.";
            header('Location: ../views/editProfile.php?mensaje=Lo sentimos no se puede subir el archivo');
          }
        }
      }


    //fin clase
  }


if(isset($_GET['action'])){
  switch ($_GET['action']) {
    case 'registrarUsuario':
      $usuarios = new Usuario;
      $usuarios->registarUsuario();
      break;
    case 'iniciarSession':
        $usuarios = new Usuario;
        $usuarios->iniciarSession();
        break;

    case 'cerrar':
        $usuarios = new Usuario;
        $usuarios->cerrar();
        break;

    case 'actualizarUsuario':
        $usuarios = new Usuario;
        $usuarios->actualizarUsuario();
        break;

    case 'eliminarCuenta':
        $usuarios = new Usuario;
        $usuarios->eliminarCuenta();
        break;

    case 'cambiarImagen':
        $usuarios = new Usuario;
        $usuarios->cambiarImagen();
        break;

    default:
      // code...
      break;
}
  }
