<?php
  session_start();
  if(($_SESSION['lvl']!=1)&&($_SESSION['lvl']!=2)){
    header('location: index.php?Sin_Trampa');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Samy Mahmod">
    <meta name="application-name" content="Aeropass">
      <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" >

    <link rel="shortcut icon" href="img/favicon.ico">
    <title>Aeropass</title>
  </head>
  <body style="background-color:rgb(231, 231, 231)">
    <nav class="navbar-brand d-flex justify-content-center " >
    <a class="nav-item" href="#">
     <img src="img/Logo001.png" alt="Logo" class="d-inline-block align-content-center">
    </a>
    </nav>

<div class="container" >

<div class="row">
  <div class="col-lg-12" align="center">

    <form action="lista01.php" method="post">
      <p>Determine en que seccion desea consultar</p>
      <input id="pasajero" type="radio" name="cTipo" value="pasajero" checked><label for="pasajero">Pasajero</label>
      <input id="destino" type="radio" name="cTipo" value="destino"><label for="destino">Destino</label>
      <input id="vuelo" type="radio" name="cTipo" value="vuelo"><label for="vuelo">Vuelo</label>
      <?php
      if($_SESSION['lvl']==1){
        echo (' <input id="usuario" type="radio" name="cTipo" value="usuario"><label for="usuario">Usuario</label>  ');
      }
      ?>
      <input type="submit" name="" value="Continuar">
    </form>

  </div>

</div>





</div>



<hr />

<footer>
  <div class="container" align="center" style="margin-top:20%">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p class="copyright text-muted">
          Todos los derechos reservados © 2017 Samy Mahmod - C.I: V-17.847.186</p>
      </div>
    </div>
  </div>
</footer>




<script src="js/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>
