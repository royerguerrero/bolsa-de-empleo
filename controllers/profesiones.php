<?php

  require '../models/conexion.php';

  class Profesiones extends Conecxion{

    public function Profesiones(){
      parent::__construct();
    }


    public function getTipoProfesion(){
      $sql = "SELECT * FROM tiposdeprofesiones";
      $result = $this->conn->query($sql);

      $tipoProfesion = $result->fetch_all(MYSQLI_ASSOC);
      return $tipoProfesion;
    }

    public function getRoles(){
      $sql = "SELECT * FROM roles";
      $result = $this->conn->query($sql);

      $roles = $result->fetch_all(MYSQLI_ASSOC);
      return $roles;
    }
  }
