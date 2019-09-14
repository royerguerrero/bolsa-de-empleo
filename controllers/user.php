<?php

  require '../models/conexion.php';

  class Usuario extends Conecxion{

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

      header('Location: ../public/landing.html');
    }
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

    default:
      // code...
      break;
}
  }
