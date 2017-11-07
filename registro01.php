<?php
  session_start();
  if(($_SESSION['lvl']!=1)&&($_SESSION['lvl']!=2)){
    header('location: index.php?Sin_Trampa');
  }
  require_once('bbdd/conexion.php');

  echo('<pre>');
  print_r($_POST);
  echo('</pre>');

  switch ($_POST['cTipo']) {
    case 'pasajero':{
    $ciPasajero=$_POST['ciPasajero'];
    $nombrePasajero=$_POST['nombrePasajero'];
    $apellidoPasajero=$_POST['apellidoPasajero'];
    $telfPasajero=$_POST['telfPasajero'];
    $numVuelo=$_POST['numVuelo'];

    $query= "INSERT INTO Pasajeros (ciPasajero, nombrePasajero, apellidoPasajero, telfPasajero, numVuelo) VALUES(?,?,?,?,?)";
        if($sentencia = mysqli_prepare($enlace, $query)){
          mysqli_stmt_bind_param($sentencia, "isssi",$ciPasajero, $nombrePasajero, $apellidoPasajero, $telfPasajero, $numVuelo);
          mysqli_stmt_execute($sentencia);
          mysqli_stmt_close($sentencia);
          header('location: inicio.php?datos=registrados');
        }

    }
      break;
    case 'destino':{
      $codDestino=$_POST['codDestino'];
      $nombreDestino=$_POST['nombreDestino'];
      $idUser=$_SESSION['user'];

      $query= "INSERT INTO Destinos (codDestino, nombreDestino, idUser) VALUES(?,?,?)";
          if($sentencia = mysqli_prepare($enlace, $query)){
            mysqli_stmt_bind_param($sentencia, "sss",$codDestino, $nombreDestino, $idUser);
            mysqli_stmt_execute($sentencia);
            mysqli_stmt_close($sentencia);
            header('location: inicio.php?datos=registrados');
          }
    }
      break;
    case 'vuelo':{
      $numVuelo=$_POST['numVuelo'];
      $placaVuelo=$_POST['placaVuelo'];
      $horaVuelo=$_POST['horaVuelo'];
      $codDestino=$_POST['codDestino'];

      $query= "INSERT INTO Vuelos (placaVuelo, horaVuelo, codDestino) VALUES(?,?,?)";
          if($sentencia = mysqli_prepare($enlace, $query)){
            mysqli_stmt_bind_param($sentencia, "sss",$placaVuelo, $horaVuelo, $codDestino);
            mysqli_stmt_execute($sentencia);
            mysqli_stmt_close($sentencia);
            header('location: inicio.php?datos=registrados');
          }
    }
      break;
    case 'usuario':{
      $idUser=$_POST['idUser'];
      $claveUser=md5($_POST['claveUser']);
      $nombreUser=$_POST['nombreUser'];
      $apellidoUser=$_POST['apellidoUser'];
      $ciUser=$_POST['ciUser'];
      $telfUser=$_POST['telfUser'];
      $lvlUser=$_POST['lvlUser'];

      if($lvlUser){
        echo $lvlUser;
      }
      else{
        $lvlUser = 2;
        echo $lvlUser;
      }
      $query= "INSERT INTO Usuarios (idUser, claveUser, nombreUser, apellidoUser, ciUser, telfUser, lvlUser) VALUES(?,?,?,?,?,?,?)";
          if($sentencia = mysqli_prepare($enlace, $query)){
            mysqli_stmt_bind_param($sentencia, "ssssisi",$idUser, $claveUser, $nombreUser, $apellidoUser, $ciUser, $telfUser, $lvlUser);
            mysqli_stmt_execute($sentencia);
            mysqli_stmt_close($sentencia);
            header('location: inicio.php?datos=registrados');
          }
    }
      break;

    default:
      header('location: inicio.php?No hagas trampas');
      break;
  }
?>
