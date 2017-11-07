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
  case 'destino':{
    $codDestino = $_POST['codDestino'];
    $nombreDestino = $_POST['nombreDestino'];
    $idUser = $_POST['idUser'];

    $query = "UPDATE Destinos SET codDestino=?, nombreDestino=?, idUser=? WHERE codDestino=?";
    $sentencia = mysqli_prepare($enlace, $query);
    if ($sentencia) {
      mysqli_stmt_bind_param($sentencia,"ssss", $codDestino, $nombreDestino, $idUser, $codDestino);
      mysqli_stmt_execute($sentencia);
      mysqli_stmt_close($sentencia);
      header('location: inicio.php?datos=editados');
    } else {
      header('location: inicio.php?datos=error');
    }
  }
  break;

  case 'pasajero':{
    $ciPasajero = $_POST['ciPasajero'];
    $nombrePasajero = $_POST['nombrePasajero'];
    $apellidoPasajero = $_POST['apellidoPasajero'];
    $telfPasajero = $_POST['telfPasajero'];
    $numVuelo = $_POST['numVuelo'];

    $query = "UPDATE Pasajeros SET ciPasajero=?, nombrePasajero=?, apellidoPasajero=?, telfPasajero=?, numVuelo=? WHERE ciPasajero=? ";
		$sentencia = mysqli_prepare($enlace, $query);
		if ($sentencia) {
			mysqli_stmt_bind_param($sentencia,"isssii", $ciPasajero, $nombrePasajero, $apellidoPasajero, $telfPasajero, $numVuelo, $ciPasajero);
			mysqli_stmt_execute($sentencia);
		  mysqli_stmt_close($sentencia);
		  header('location: inicio.php?datos=editados');
		} else {
			header('location: inicio.php?datos=error');
		}
  }
    break;
  case 'vuelo':{
    $numVuelo = $_POST['numVuelo'];
    $placaVuelo = $_POST['placaVuelo'];
    $horaVuelo = $_POST['horaVuelo'];
    $codDestino = $_POST['codDestino'];

    $query = "UPDATE Vuelos SET numVuelos=?, placaVuelo=?, horaVuelo=?, codDestino=? WHERE numVuelo=? ";
		$sentencia = mysqli_prepare($enlace, $query);
		if ($sentencia) {
			mysqli_stmt_bind_param($sentencia,"isssi", $numVuelos, $placaVuelo, $horaVuelo, $codDestino, $numVuelo);
			mysqli_stmt_execute($sentencia);
		  mysqli_stmt_close($sentencia);
		  header('location: inicio.php?datos=editados');
		} else {
			header('location: inicio.php?datos=error');
		}
  }
     break;
  case 'usuario':{
    $idUser = $_POST['idUser'];
    $claveUser = $_POST['claveUser'];
    $nombreUser = $_POST['nombreUser'];
    $apellidoUser = $_POST['apellidoUser'];
    $ciUser = $_POST['ciUser'];
    $telfUser = $_POST['telfUser'];
    $lvlUser = $_POST['lvlUser'];

    $query = "UPDATE Usuarios SET idUser=?, claveUser=?, nombreUser=?, apellidoUser=?, ciUser=?, telfUser=?, lvlUser=? WHERE idUser=? ";
		$sentencia = mysqli_prepare($enlace, $query);
		if ($sentencia) {
			mysqli_stmt_bind_param($sentencia,"ssssisis", $idUser, $claveUser, $nombreUser, $apellidoUser, $ciUser, $telfUser, $lvlUser, $idUser);
			mysqli_stmt_execute($sentencia);
		  mysqli_stmt_close($sentencia);
		  header('location: inicio.php?datos=editados');
		} else {
			header('location: inicio.php?datos=error');
		}
  }
    break;

  default:
    echo 'Diossssssss. ya quiero terminar... XD';
    break;
}

  require_once('bbdd/cerrar.php');
?>
