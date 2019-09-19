<?php
session_start();
if(isset($_SESSION['rol'])){
    if ($_SESSION['rol'] == 'Admin') {
      header('Location: views/dash.php');
    }elseif($_SESSION['rol'] == 'User'){
      header('Location: views/home.php');
    }else{
      header('Location: public/landing.php');
    }
}else{
  header('Location: public/landing.php');
}
