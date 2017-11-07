<?php
  session_start();
  if(($_SESSION['lvl']!=1)&&($_SESSION['lvl']!=2)){
    header('location: index.php?Sin_Trampa');
  }
  require_once('bbdd/conexion.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Samy Mahmod">
    <meta name="application-name" content="Aeropass">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/css1" />
    <title>Aeropass</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">

      </head>
      <body style="background-color:rgb(231, 231, 231)">
        <div class="wrapper">
          <nav class="navbar-brand d-flex justify-content-center " >
          <a class="nav-item" href="inicio.php">
           <img src="img/Logo001.png" alt="Logo" class="d-inline-block align-content-center">
          </a>
          </nav>

        <div class="container-fluid">
          <div class="col-lg-12" align="center">

  <?php
/*
    echo('<pre>');
    print_r($_GET);
    echo('</pre>');
*/
    switch ($_GET['cTipo']) {
      case 'pasajero':{
        echo (' <table class="table table-hover table-stripered table-responsive table-bordered">');
        echo (' <thead>');
    		echo (' <tr>');
    		echo (' <th>Cedula</th>');
    		echo (' <th>Nombre</th>');
    		echo (' <th>Apellido</th>');
    		echo (' <th>Telefono</th>');
    		echo (' <th>Num. Vuelo</th>');
    		echo (' <th>Modificar</th>');
        echo (' <th>Reset</th>');
    		echo (' </tr>');
    		echo (' </thead>');

        $query = "SELECT * FROM Pasajeros WHERE ciPasajero=$_GET[ciPasajero]";
				$sentencia = mysqli_query($enlace, $query);

				while($fila = mysqli_fetch_array($sentencia)){
          $ciPasajero = $fila['ciPasajero'];
          $nombrePasajero = $fila['nombrePasajero'];
          $apellidoPasajero = $fila['apellidoPasajero'];
          $telfPasajero = $fila['telfPasajero'];
          $numVuelo = $fila['numVuelo'];

					echo '<tr>';
          echo '<form class="" action="editar02.php" method="post">';
		      echo '<th scope=\"row\">'. $ciPasajero.'</th>';
		      echo '<td><input type="text" name="nombrePasajero" value="'.$nombrePasajero.'" required></td>';
		      echo '<td><input type="text" name="apellidoPasajero" value="'.$apellidoPasajero.'" required></td>';
		      echo '<td><input type="text" name="telfPasajero" value="'.$telfPasajero.'" required></td>';
		      echo '<td><input type="text" name="numVuelo" value="'.$numVuelo.'" required></td>';
          echo '<input type="hidden" name="cTipo" value="pasajero" required>';
          echo '<input type="hidden" name="ciPasajero" value="'.$ciPasajero.'" required>';
		      echo '<td><input type="submit" name="" value="Actualizar"></td>';
          echo '<td><input type="reset" name="" value="Reset"></td>';
          echo '</form>';
				  echo '</tr>';
          echo "</table>";
        }

      }
        break;

      case 'destino':{
        $codDestino=$_GET['codDestino'];
        echo (' <table class="table table-hover table-stripered table-responsive table-bordered">');
        echo (' <thead>');
    		echo (' <tr>');
    		echo (' <th>Cod. Destino</th>');
    		echo (' <th>Nombre</th>');
        echo (' <th>Id Usuario</th>');
        echo (' <th>Modificar</th>');
        echo (' <th>Reset</th>');
    		echo (' </tr>');
    		echo (' </thead>');
        $query = 'SELECT * FROM Destinos WHERE codDestino="'.$codDestino.'"';
				$sentencia = mysqli_query($enlace, $query);

        while($fila = mysqli_fetch_array($sentencia)){
          $codDestino = $fila['codDestino'];
          $nombreDestino = $fila['nombreDestino'];
          $idUser = $fila['idUser'];

					echo "<tr>";
          echo '<form class="" action="editar02.php" method="post">';
		      echo "<th scope=\"row\">". $codDestino. "</th>";
		      echo '<td><input type="text" name="nombreDestino" value="'.$nombreDestino.'" required></td>';
		      echo '<td><input type="text" name="idUser" value="'.$idUser.'" required></td>';
          echo '<input type="hidden" name="cTipo" value="destino" required>';
          echo '<input type="hidden" name="ciPasajero" value="'.$codDestino.'" required>';
          if($_SESSION['lvl']==1){
            echo '<td><input type="submit" name="" value="Actualizar"></td>';
            echo '<td><input type="reset" name="" value="Reset"></td>';
          }
          echo '</form>';
				  echo "</tr>";
          echo "</table>";
				}
      }
        break;

      case 'vuelo':{
        echo (' <table class="table table-hover table-stripered table-responsive table-bordered">');
        echo (' <thead>');
    		echo (' <tr>');
    		echo (' <th>Num. Vuelo</th>');
    		echo (' <th>Placa</th>');
        echo (' <th>Hora</th>');
    		echo (' <th>Cod. Destino</th>');
        if($_SESSION['lvl']==1){
          echo (' <th>Modificar</th>');
          echo (' <th>Reset</th>');
        }
    		echo (' </tr>');
    		echo (' </thead>');

        $query = "SELECT * FROM Vuelos WHERE numVuelo=$_GET[numVuelo]";
				$sentencia = mysqli_query($enlace, $query);

				while($fila = mysqli_fetch_array($sentencia)){
          $numVuelo = $fila['numVuelo'];
          $placaVuelo = $fila['placaVuelo'];
          $horaVuelo = $fila['horaVuelo'];
          $codDestino = $fila['codDestino'];

					echo "<tr>";
          echo '<form class="" action="editar02.php" method="post">';
		      echo "<th scope=\"row\">". $numVuelo. "</th>";
		      echo '<td><input type="text" name="placaVuelo" value="'.$placaVuelo.'" required></td>';
		      echo '<td><input type="text" name="horaVuelo" value="'.$horaVuelo.'" required></td>';
		      echo '<td><input type="text" name="codDestino" value="'.$codDestino.'" required></td>';
          echo '<input type="hidden" name="cTipo" value="vuelo" required>';
          echo '<input type="hidden" name="ciPasajero" value="'.$numVuelo.'" required>';
          if($_SESSION['lvl']==1){
            echo '<td><input type="submit" name="" value="Actualizar"></td>';
            echo '<td><input type="reset" name="" value="Reset"></td>';
          }
          echo '</form>';
				  echo "</tr>";
          echo "</table>";
				}
      }
        break;

      case 'usuario':{
        $idUser=$_GET['idUser'];
        echo (' <table class="table table-hover table-stripered table-responsive table-bordered">');
        echo (' <thead>');
    		echo (' <tr>');
    		echo (' <th>Id</th>');
    		echo (' <th>Clave</th>');
        echo (' <th>Nombre</th>');
    		echo (' <th>Apellido</th>');
        echo (' <th>Cedula</th>');
    		echo (' <th>Telefono</th>');
        echo (' <th>Nivel</th>');
        if($_SESSION['lvl']==1){
          echo (' <th>Modificar</th>');
          echo (' <th>Eliminar</th>');
        }
    		echo (' </tr>');
    		echo (' </thead>');

        $query = 'SELECT * FROM Usuarios WHERE idUser="'.$idUser.'"';
				$sentencia = mysqli_query($enlace, $query);

				while($fila = mysqli_fetch_array($sentencia)){
          $idUser = $fila['idUser'];
          $claveUser = $fila['claveUser'];
          $nombreUser = $fila['nombreUser'];
          $apellidoUser = $fila['apellidoUser'];
          $ciUser = $fila['ciUser'];
          $telfUser = $fila['telfUser'];
          $lvlUser = $fila['lvlUser'];

					echo "<tr>";
          echo '<form class="" action="editar02.php" method="post">';
		      echo "<th scope=\"row\">". $idUser.'</td>';
		      echo '<td><input type="text" name="claveUser" value="'.$claveUser.'" required></td>';
		      echo '<td><input type="text" name="nombreUser" value="'.$nombreUser.'" required></td>';
		      echo '<td><input type="text" name="apellidoUser" value="'.$apellidoUser.'" required></td>';
		      echo '<td><input type="text" name="ciUser" value="'.$ciUser.'" required></td>';
          echo '<td><input type="text" name="telfUser" value="'.$telfUser.'" required></td>';
          echo '<td><input type="text" name="lvlUser" value="'.$lvlUser.'" required></td>';
          echo '<input type="hidden" name="cTipo" value="usuario">';
          echo '<input type="hidden" name="ciPasajero" value="'.$idUser.'" required>';
          if($_SESSION['lvl']==1){
            echo '<td><input type="submit" name="" value="Actualizar"></td>';
            echo '<td><input type="reset" name="" value="Reset"></td>';
          }
          echo '</form>';
				  echo "</tr>";
          echo "</table>";
        }
      }
        break;

      default:{
        echo 'Si sigues lo vas a joder';
        break;
      }
    }
  ?>

</div>
</div>

<hr>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

        <p class="copyright text-muted">Todos los derechos reservados © 2017 Samy Mahmod - C.I: V-17.847.186</p>
      </div>
    </div>
  </div>
</footer>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
    <?php  require_once('bbdd/cerrar.php');
      ?>
    </html>
