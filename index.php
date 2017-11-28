<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Samy Mahmod">
    <meta name="application-name" content="Aeropass">
    <link rel="stylesheet" href="css/css1" />
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" >

    <title>Aeropass</title>
  </head>
  <body style="background-color:rgb(231, 231, 231)">

    <nav class="navbar-brand d-flex justify-content-center " >
    <a class="nav-item" href="#">
     <img src="img/Logo001.png" alt="Logo" class="d-inline-block align-content-center">
    </a>
    </nav>

    <section>
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12">

          </div>

        </div>


        <div class="row d-flex justify-content-center">
          <div class="col-5">
            <form action="manejador.php" method="post" class="form-signin">

                  <input type="text" name="user" placeholder="Usuario" class="form-control" required>



                <input type="password" name="password" placeholder="Contraseña" class="form-control" required>


              <input type="submit" value="Ingresar">
            </form>
          </div>
        </div>

      </div>

    </section>
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
