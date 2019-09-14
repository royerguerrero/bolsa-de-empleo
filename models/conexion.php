<?php

  require 'config.php';

  class Conecxion{

    protected $conn;

    public function Conecxion(){
      $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
        }
        //echo "Connected successfully";
    }

  }
