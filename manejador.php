<?php

//Muestra los datos que se reciven por el metodo _POST
echo('<pre>');
print_r($_POST);
echo('</pre>');

//Funcion para trabajar con seciones
session_start();

require_once('bbdd/conexion.php');

//Se validan que los campos de usuario y clave contengan datos
if(isset($_POST['user']) && (isset($_POST['password']))){
  echo "funciona1";
  if(($_POST['user']!="") && ($_POST['password']!="")){
    echo "funciona2";
    $user = $_POST['user'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM Usuarios WHERE idUser = ? AND claveUser = ?";

    if($sentencia = mysqli_prepare($enlace,$query)){
      echo "funciona3";
      mysqli_stmt_bind_param($sentencia, "ss", $user , $password);
      mysqli_stmt_execute($sentencia);
      mysqli_stmt_store_result($sentencia);
      mysqli_stmt_bind_result($sentencia, $idUser, $claveUser, $nombre, $apellido, $ci, $telf, $lvlUser);
      $rowCount = mysqli_stmt_num_rows($sentencia);
      if($rowCount>0) {
        echo "funciona4";
        while (mysqli_stmt_fetch($sentencia)) {
              $_SESSION['user']=$user;
              $_SESSION['password']=$password;
              $_SESSION['nombre']=$nombre;
              $_SESSION['apellido']=$apellido;
              $_SESSION['ci']=$ci;
              $_SESSION['telf']=$telf;
              $_SESSION['lvl']=$lvlUser;
          }
            header('location: inicio.php');
      }
      else{
          header('location: index.php?usuario_invalido');
      }
        mysqli_stmt_close($sentencia);
    }
  }
  else{
    header('location: index.php?error=noData');
  }
}
require_once("bbdd/cerrar.php");
?>
