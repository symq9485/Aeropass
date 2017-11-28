<?php
/*
echo('<pre>');
print_r($_GET);
echo('</pre>');

echo('<pre>');
print_r($_POST);
echo('</pre>');
*/
  session_start();
  if(($_SESSION['lvl']!=1)&&($_SESSION['lvl']!=2)){
    header('location: index.php?Sin_Trampa');
  }
require_once('bbdd/conexion.php');

	switch ($_GET['cTipo']) {
    case 'pasajero':{
      $cTipo = $_GET['cTipo'];
      $ciPasajero = $_GET['ciPasajero'];

      $query = "DELETE FROM Pasajeros where ciPasajero = ?";

      if ($sentencia = mysqli_prepare($enlace, $query)) {
    	    mysqli_stmt_bind_param($sentencia, "i",$ciPasajero);
    	    mysqli_stmt_execute($sentencia);
    	    mysqli_stmt_close($sentencia);
          echo ('<script type="text/javascript">
                  alert("Pasajero eliminado.");
                 </script>');
    	    //header('Location: inicio.php?datos=eliminados');
    	 } else {
         echo ('<script type="text/javascript">
                 alert("Pasajero no existe.");
                </script>');
    	    //header('Location:lista01.php?error');
    	 }
    }
	    break;

      case 'vuelo':{
        $cTipo = $_GET['cTipo'];
        $numVuelo = $_GET['numVuelo'];

        $query = "DELETE FROM Pasajeros where numVuelo = ?";

        if ($sentencia = mysqli_prepare($enlace, $query)) {
      	    mysqli_stmt_bind_param($sentencia, "i",$numVuelo);
      	    mysqli_stmt_execute($sentencia);
      	    mysqli_stmt_close($sentencia);

            $query = "DELETE FROM Vuelos where numVuelo = ?";
            if ($sentencia = mysqli_prepare($enlace, $query)) {
          	    mysqli_stmt_bind_param($sentencia, "i",$numVuelo);
          	    mysqli_stmt_execute($sentencia);
          	    mysqli_stmt_close($sentencia);
                header('Location: inicio.php?datos=eliminados');
            } else {
         	    header('Location:lista01.php?error');
         	 }
        }
      }
      break;

    case 'destino':{
      $cTipo= $_GET['cTipo'];
      $codDestino= $_GET['codDestino'];

      $query="SELECT codDestino FROM Destinos WHERE codDestino= ?";

      if ($sentencia = mysqli_prepare($enlace, $query)) {
        mysqli_stmt_bind_param($sentencia, 's', $codDestino);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_store_result($sentencia);
        $response = mysqli_stmt_bind_result($sentencia, $codDestino);
        $rows = mysqli_stmt_num_rows($sentencia);
        if ($rows > 0) {
          $query="SELECT numVuelo FROM Vuelos WHERE codDestino= ?";
          if ($sentencia2 = mysqli_prepare($enlace, $query)) {
            mysqli_stmt_bind_param($sentencia2, 's', $codDestino);
            mysqli_stmt_execute($sentencia2);
            if(mysqli_stmt_get_result($sentencia2)){
              $resultado = mysqli_stmt_get_result($sentencia2);
              $result = $resultado;
              while($fila=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $query="DELETE FROM Pasajeros WHERE numVuelo=$fila[numVuelo]";
                $resultado=mysqli_query($enlace, $query);
              }
            }

            mysqli_stmt_close($sentencia2);
          }

          $query="DELETE FROM Vuelos WHERE codDestino=?";
          if ($sentencia2 = mysqli_prepare($enlace, $query)) {
            mysqli_stmt_bind_param($sentencia2, 's', $codDestino);
            mysqli_stmt_execute($sentencia2);
            mysqli_stmt_close($sentencia2);
          }
          $query="DELETE FROM Destinos WHERE codDestino=?";
          if ($sentencia2 = mysqli_prepare($enlace, $query)) {
            mysqli_stmt_bind_param($sentencia2, 's', $codDestino);
            mysqli_stmt_execute($sentencia2);
            mysqli_stmt_close($sentencia2);
          }
        }
        header('Location: inicio.php?datos=eliminados');
      }
      else {
        header('Location:inicio.php?error');
      }
    }
	    break;

    case 'usuario':{
      $cTipo= $_GET['cTipo'];
      $idUser= $_GET['idUser'];

      $query="SELECT codDestino FROM Destinos WHERE idUser= ?";

      if($sentencia = mysqli_prepare($enlace, $query)){
        mysqli_stmt_bind_param($sentencia, 's', $idUser);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_bind_result($sentencia, $codDestino);


        while(mysqli_stmt_fetch($sentencia)){}
        }

      $query = "SELECT numVuelo FROM Vuelos WHERE codDestino=?";

      if($sentencia= mysqli_prepare($enlace,$query)){
        mysqli_stmt_bind_param($sentencia,'s',$codDestino);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_bind_result($sentencia, $numVuelo);
        while(mysqli_stmt_fetch($sentencia)){}
        }
echo $codDestino;
echo $numVuelo;

      $query= "DELETE FROM Pasajeros WHERE numVuelo=?";

      if ($sentencia = mysqli_prepare($enlace, $query)) {
    	    mysqli_stmt_bind_param($sentencia, "i",$numVuelo);
    	    mysqli_stmt_execute($sentencia);
    	    mysqli_stmt_close($sentencia);
    	 }
       $query= "DELETE FROM Vuelos WHERE numVuelo=?";

       if ($sentencia = mysqli_prepare($enlace, $query)) {
     	    mysqli_stmt_bind_param($sentencia, "i",$numVuelo);
     	    mysqli_stmt_execute($sentencia);
     	    mysqli_stmt_close($sentencia);
     	 }
       $query= "DELETE FROM Destinos WHERE idUser=?";

       if ($sentencia = mysqli_prepare($enlace, $query)) {
     	    mysqli_stmt_bind_param($sentencia, "s",$idUser);
     	    mysqli_stmt_execute($sentencia);
     	    mysqli_stmt_close($sentencia);
     	 }
       $query= "DELETE FROM Usuarios WHERE idUser=?";

       if ($sentencia = mysqli_prepare($enlace, $query)) {
     	    mysqli_stmt_bind_param($sentencia, "s",$idUser);
     	    mysqli_stmt_execute($sentencia);
     	    mysqli_stmt_close($sentencia);
     	 }


      header('Location: inicio.php?datos=eliminados');
    }
	    break;

	  default:
	    echo ('Por favor funciona');
	    break;
	}






	require_once('bbdd/cerrar.php');
?>
