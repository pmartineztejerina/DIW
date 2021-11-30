<?php
session_start();
$_SESSION['EMAIL'] = "";
$_SESSION['PASSWORD'] = "";
$_SESSION['USUARIOBLOQUEADO']="visibility: hidden";
/*session is started if you don't write this line can't use $_Session  global variable*/

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LOG IN</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">

      <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-213815123-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-213815123-1');
</script>
</head>

<body>
    <section class="login-dark">
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container"><a class="navbar-brand" href="#">FORMULARIO REGISTRO DIW</a>
            <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav me-auto"></ul> 
                    <span class="navbar-text actions"> 
                      <a class="login" href="login.php">Log In</a>
                      <a class="btn btn-light action-button" role="button" href="signUp.php">Sign Up</a>
                    </span>
                </div>
            </div>
        </nav>
        <form action="compruebaLogin.php" method="POST">
            <h2 class="visually-hidden">FORMULARIO LOG IN</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="email" name="EMAIL" placeholder="Email" required ></div>
            <div class="mb-3"><input class="form-control" type="password" name="PASSWORD" placeholder="Contraseña" required></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a>
        </form>
    </section>
    <div class="modal modal-alert position-fixed d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalChoice" style="background-color: rgba(0, 0, 0, 0.5);<?php echo $_SESSION['USUARIOBLOQUEADO']; ?>">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-4 shadow">
            <div class="modal-body p-4 text-center">
              <h5 class="mb-0">Ha excedido los intentos de acceder a la cuenta</h5>
              <p class="mb-0">Contacte con el administrador para su desbloqueo</p>
            </div>
            <div class="modal-footer flex-nowrap p-0">
              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal" onclick="document.getElementById('modalChoice').style.visibility = 'hidden'">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>