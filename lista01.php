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
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/registros.js"></script>
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

    <div class="container">
      <div class="col-lg-12" align="center">


        <?php
        switch ($_POST['cTipo']) {
          case 'pasajero':{
            echo (' <table class="table table-responsive table-hover table-bordered">');
            echo (' <thead>');
            echo (' <tr>');
            echo (' <th>Cedula</th>');
            echo (' <th>Nombre</th>');
            echo (' <th>Apellido</th>');
            echo (' <th>Telefono</th>');
            echo (' <th>Num. Vuelo</th>');
            echo (' <th>Modificar</th>');
            echo (' <th>Eliminar</th>');
            echo (' </tr>');
            echo (' </thead>');

            $query = "SELECT * FROM Pasajeros";
            $sentencia = mysqli_query($enlace, $query);

            while($fila = mysqli_fetch_array($sentencia)){
              $ciPasajero = $fila['ciPasajero'];
              $nombrePasajero = $fila['nombrePasajero'];
              $apellidoPasajero = $fila['apellidoPasajero'];
              $telfPasajero = $fila['telfPasajero'];
              $numVuelo = $fila['numVuelo'];

              echo "<tr>";
              echo "<th scope=\"row\">". $ciPasajero. "</th>";
              echo "<td>" .$nombrePasajero. "</td>";
              echo "<td>" .$apellidoPasajero. "</td>";
              echo "<td>" .$telfPasajero. "</td>";
              echo "<td>" .$numVuelo. "</td>";
              echo "<td><a href=\"editar01.php?ciPasajero=". $ciPasajero. "&cTipo=pasajero\">Editar</a></td>";
              echo "<td><a href=\"eliminar01.php?ciPasajero=". $ciPasajero ."&cTipo=pasajero\">Eliminar</a></td>";
              echo "</tr>";
            }
            echo('  <form>');
            if($_SESSION['lvl']==1){
              switch ($_POST['cTipo']) {
                case 'pasajero':{
                  echo ('<tr>
                  <td><input id="ciPasajero" type="text" name="ciPasajero" value="" placeholder="Cedula" required></td>
                  <td><input id="nombrePasajero" type="text" name="nombrePasajero" value="" placeholder="Nombre" required></td>
                  <td><input id="apellidoPasajero" type="text" name="apellidoPasajero" value="" placeholder="Apellido" required></td>
                  <td><input id="telfPasajero" type="text" name="telfPasajero" value="" placeholder="Telefono" required></td>
                  <td><input id="numVuelo" type="text" name="numVuelo" value="" placeholder="Vuelo" required></td>
                  <td><input id="cTipo" type="hidden" name="cTipo" value="'.$_POST['cTipo'].'">
                  <input id="rpasajero" type="reset" name="" value="Registrar"></td>
                  <td><input type="reset" value="Reset"></td>
                  </tr>');

                }
                break;
              }
            }
            else{
              echo ('<tr>
              <td><input type="text" name="ciPasajero" value="" placeholder="Cedula" required></td>
              <td><input type="text" name="nombrePasajero" value="" placeholder="Nombre" required></td>
              <td><input type="text" name="apellidoPasajero" value="" placeholder="Apellido" required></td>
              <td><input type="text" name="telfPasajero" value="" placeholder="Telefono" required></td>
              <td><input type="text" name="numVuelo" value="" placeholder="Vuelo" required></td>
              <td><input type="hidden" name="cTipo" value="'.$_POST['cTipo'].'">
              <input type="submit" name="" value="Registrar"></td>
              <td><input type="reset" value="Reset"></td>
              </tr>');
            }
          }
            break;

          case 'destino':{
            echo (' <table class="table table-bordered table-hover table-responsive table-stripered">');
            echo (' <thead>');
            echo (' <tr>');
            echo (' <th>Cod. Destino</th>');
            echo (' <th>Nombre</th>');
            echo (' <th>idUsuario</th>');
            if($_SESSION['lvl']==1){
              echo (' <th>Modificar</th>');
              echo (' <th>Eliminar</th>');
            }
            echo (' </tr>');
            echo (' </thead>');

            $query = "SELECT * FROM Destinos";
            $sentencia = mysqli_query($enlace, $query);

            while($fila = mysqli_fetch_array($sentencia)){
              $codDestino = $fila['codDestino'];
              $nombreDestino = $fila['nombreDestino'];
              $idUser = $fila['idUser'];

              echo "<tr>";
              echo "<th scope=\"row\">". $codDestino. "</th>";
              echo "<td>" .$nombreDestino. "</td>";
              echo "<td>" .$idUser. "</td>";
              if($_SESSION['lvl']==1){
                echo "<td><a href=\"editar01.php?codDestino=". $codDestino. "&cTipo=destino\">Editar</a></td>";
                echo "<td><a href=\"eliminar01.php?codDestino=". $codDestino ."&cTipo=destino\">Eliminar</a></td>";
              }
              echo "</tr>";
            }
            echo('  <form action="registro01.php" method="post">');
            if($_SESSION['lvl']==1){
              switch ($_POST['cTipo']) {
                case 'destino':{
                  echo ('<tr>
                  <td><input type="text" name="codDestino" value="" placeholder="Cod. IATA, ej.: CCS o VLN" required></td>
                  <td><input type="text" name="nombreDestino" value="" placeholder="Nombre" required></td>
                  <td>'.$_SESSION['user'].'</td>
                  <td><input type="hidden" name="cTipo" value="'.$_POST['cTipo'].'">
                  <input type="submit" name="" value="Registrar"></td>
                  <td><input type="reset" value="Reset"></td>
                  </tr>');
                }
                break;
              }
            }
          }
            break;

          case 'vuelo':{
            echo (' <table class="table table-bordered table-hover table-responsive table-stripered">');
            echo (' <thead>');
            echo (' <tr>');
            echo (' <th>Num. Vuelo</th>');
            echo (' <th>Placa</th>');
            echo (' <th>Hora</th>');
            echo (' <th>Cod. Destino</th>');
            if($_SESSION['lvl']==1){
              echo (' <th>Modificar</th>');
              echo (' <th>Eliminar</th>');
            }
            echo (' </tr>');
            echo (' </thead>');

            $query = "SELECT * FROM Vuelos";
            $sentencia = mysqli_query($enlace, $query);

            while($fila = mysqli_fetch_array($sentencia)){
              $numVuelo = $fila['numVuelo'];
              $placaVuelo = $fila['placaVuelo'];
              $horaVuelo = $fila['horaVuelo'];
              $codDestino = $fila['codDestino'];

              echo "<tr>";
              echo "<th scope=\"row\">". $numVuelo. "</th>";
              echo "<td>" .$placaVuelo. "</td>";
              echo "<td>" .$horaVuelo. "</td>";
              echo "<td>" .$codDestino. "</td>";
              if($_SESSION['lvl']==1){
                echo "<td><a href=\"editar01.php?numVuelo=". $numVuelo."&cTipo=vuelo\">Editar</a></td>";
                echo "<td><a href=\"eliminar01.php?numVuelo=". $numVuelo ."&cTipo=vuelo\">Eliminar</a></td>";
              }
              echo "</tr>";
            }
            echo('  <form action="registro01.php" method="post">');
            if($_SESSION['lvl']==1){
              switch ($_POST['cTipo']) {
                case 'vuelo':{
                  echo ('<tr>
                  <td>Automatico</td>
                  <td><input type="text" name="placaVuelo" value="" placeholder="Placa del avion" required></td>
                  <td><input type="time" name="horaVuelo" value="" placeholder="Hora del vuelo - hhmmss" required></td>
                  <td><input type="text" name="codDestino" value="" placeholder="Cod. IATA, ej.: CCS o VLN" required></td>
                  <td><input type="hidden" name="cTipo" value="'.$_POST['cTipo'].'">
                  <input type="submit" name="" value="Registrar"></td>
                  <td><input type="reset" value="Reset"></td>
                  </tr>');
                }
                break;
              }
            }
          }
            break;

          case 'usuario':{
            echo (' <table class="table table-bordered table-hover table-responsive table-stripered">');
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

            $query = "SELECT * FROM Usuarios";
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
              echo "<th scope=\"row\">". $idUser. "</th>";
              echo "<td>" .$claveUser. "</td>";
              echo "<td>" .$nombreUser. "</td>";
              echo "<td>" .$apellidoUser. "</td>";
              echo "<td>" .$ciUser. "</td>";
              echo "<td>" .$telfUser. "</td>";
              echo "<td>" .$lvlUser. "</td>";
              if($_SESSION['lvl']==1){
                echo "<td><a href=\"editar01.php?idUser=". $idUser. "&cTipo=usuario\">Editar</a></td>";
                echo "<td><a href=\"eliminar01.php?idUser=". $idUser ."&cTipo=usuario\">Eliminar</a></td>";
              }
              echo "</tr>";
            }
            echo('  <form action="registro01.php" method="post">');
            if($_SESSION['lvl']==1){
              switch ($_POST['cTipo']) {
                case 'usuario':{
                  echo('<tr>
                  <td><input type="text" name="idUser" value="" placeholder="Id" required></td>
                  <td><input type="text" name="claveUser" value="" placeholder="Contraseña" required></td>
                  <td><input type="text" name="nombreUser" value="" placeholder="Nombre" required></td>
                  <td><input type="text" name="apellidoUser" value="" placeholder="Apellido" required></td>
                  <td><input type="text" name="ciUser" value="" placeholder="Cedula" required></td>
                  <td><input type="text" name="telfUser" value="" placeholder="Telefono" required></td>
                  <td><label for="lvlUser">Administrador</label><input id="lvlUser" type="checkbox" name="lvlUser" value="1"></td>
                  <td><input type="hidden" name="cTipo" value="'.$_POST['cTipo'].'">
                  <input type="submit" name="" value="Registrar"></td>
                  <td><input type="reset" value="Reset"></td>
                  </tr>');
                }
                  break;
              }
            }
          }
            break;

          default:
            echo 'No hagas cosas raras';
            break;
        }
        echo('  </form>');
        echo('  </table>');?>



      </div>
    </div>



</div>
<hr />
<?php echo ('<div id="datos"></div>');?>
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
