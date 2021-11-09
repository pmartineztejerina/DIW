<?php 
session_start();
    $_SESSION['EMAIL']="";
    $_SESSION['EMAILEXISTE']="visibility: hidden";
    $_SESSION['BIRTHDAY']="";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FORMULARIO DIW</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section class="login-dark">
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container"><a class="navbar-brand" href="#">FORMULARIO REGISTRO DIW</a>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav me-auto"></ul>
                    <span class="navbar-text actions"> 
                      <a class="login" href="login.php">Log In</a>
                      <a class="btn btn-light action-button" role="button" href="index.php">Sign Up</a>
                    </span>
                </div>
            </div>
        </nav>
        <form action="registroUsuario.php" method="POST">
            <h2 class="visually-hidden">FORMULARIO REGISTRO</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="email" name="EMAIL" placeholder="Email" value="<?php echo $_SESSION['EMAIL']; ?>" required ></div>
            <div class="mb-3"><input class="form-control" type="password" name="PASSWORD" placeholder="Contraseña" required></div>
            <div class="mb-3"><input class="form-control" type="password" name="PASSWORDBIS" placeholder="Repita contraseña"required></div>
            <div class="mb-3"><input class="form-control" type="date" name="BIRTHDAY" placeholder="Fecha de nacimiento" value="<?php echo $_SESSION['BIRTHDAY']; ?>"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a>
        </form>
    </section>

    <div class="modal modal-alert position-fixed d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalChoice" style="background-color: rgba(0, 0, 0, 0.5);<?php echo $_SESSION['EMAILEXISTE']; ?>">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-4 shadow">
            <div class="modal-body p-4 text-center">
              <h5 class="mb-0">Email ya registrado</h5>
              <p class="mb-0">Compruebe su email y verifique la cuenta</p>
            </div>
            <div class="modal-footer flex-nowrap p-0">
              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Volver a mandar</strong></button>
              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal" onclick="document.getElementById('modalChoice').style.visibility = 'hidden'">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>