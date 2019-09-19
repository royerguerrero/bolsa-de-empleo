<?php

  require 'config.php';

  class Conexion{

    protected $conn;

    public function Conexion(){
      $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
        }
        //echo "Connected successfully";
    }

  }
