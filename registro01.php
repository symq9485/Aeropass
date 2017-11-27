<?php
  session_start();
  if(($_SESSION['lvl']!=1)&&($_SESSION['lvl']!=2)){
    header('location: index.php?Sin_Trampa');
  }
  require_once('bbdd/conexion.php');
/*
  echo('<pre>');
  print_r($_POST);
  echo('</pre>');
*/
  switch ($_POST['cTipo']) {
    case 'pasajero':{
    $ciPasajero=$_POST['ciPasajero'];
    $nombrePasajero=$_POST['nombrePasajero'];
    $apellidoPasajero=$_POST['apellidoPasajero'];
    $telfPasajero=$_POST['telfPasajero'];
    $numVuelo=$_POST['numVuelo'];

    $query = "SELECT numVuelo FROM Vuelos WHERE numVuelo = $numVuelo";
    $sentencia = mysqli_query($enlace, $query);

    while($fila = mysqli_fetch_array($sentencia)){
      $numVuelo2 = $fila['numVuelo'];
    }

      if($numVuelo2){
        $query = "SELECT ciPasajero FROM Pasajeros WHERE ciPasajero = $ciPasajero";
        $sentencia = mysqli_query($enlace, $query);

        while($fila = mysqli_fetch_array($sentencia)){
          $ciPasajero2 = $fila['ciPasajero'];
        }
        if($ciPasajero2){
          echo ('<script type="text/javascript">
                  alert("El pasajero ya estaba registrado.\nSi desea cambiar sus datos Editelos");
                 </script>');
        }
        else{
          $query= "INSERT INTO Pasajeros (ciPasajero, nombrePasajero, apellidoPasajero, telfPasajero, numVuelo) VALUES(?,?,?,?,?)";
              if($sentencia = mysqli_prepare($enlace, $query)){
                mysqli_stmt_bind_param($sentencia, "isssi",$ciPasajero, $nombrePasajero, $apellidoPasajero, $telfPasajero, $numVuelo);
                mysqli_stmt_execute($sentencia);
                mysqli_stmt_close($sentencia);

                $query = "SELECT * FROM Pasajeros WHERE ciPasajero = $ciPasajero";
                $sentencia = mysqli_query($enlace, $query);

                while($fila = mysqli_fetch_array($sentencia)){
                  $ciPasajero = $fila['ciPasajero'];
                  $nombrePasajero = $fila['nombrePasajero'];
                  $apellidoPasajero = $fila['apellidoPasajero'];
                  $telfPasajero = $fila['telfPasajero'];
                  $numVuelo = $fila['numVuelo'];

                  echo '<div class="container">
                          <div class="col-lg-12" align="center">
                            <table class="table table-responsive table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th colspan="5">Datos guardados</th>
                                </tr>
                                <tr>
                                  <th>Cedula</th>
                                  <th>Nombre</th>
                                  <th>Apellido</th>
                                  <th>Telefono</th>
                                  <th>Num. Vuelo</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>'.$ciPasajero.'</td>
                                  <td>'.$nombrePasajero.'</td>
                                  <td>'.$apellidoPasajero.'</td>
                                  <td>'.$telfPasajero.'</td>
                                  <td>'.$numVuelo.'</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>';
                }
                //header('location: inicio.php?datos=registrados');
              }
        }
      }
      else{
        echo ('<script type="text/javascript">
                alert("En numero de vuelo no existe.\n\nIngrese un numero de vuelo valido.");
               </script>');
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
