<?php
session_start();
if (!isset($_SESSION['EMAIL'])) {
    $_SESSION['EMAIL'] = "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PERFIL ADMINISTRADOR</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark - usuario.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section class="login-dark">
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container">
                <h3 class="navbar-brand"><?php echo $_SESSION['EMAIL']; ?></h3>
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="indexAdministrador.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="perfilAdmin.php">Perfil</a></li>
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="">Administracion </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="añadirUsuario.php">Añadir usuario</a>
                                <a class="dropdown-item" href="gestionUsuarios.php">Gestion usuarios</a>
                                <a class="dropdown-item" href="consultaUsuario.php">Consulta usuarios</a>
                                <!-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Localizacion</a> -->
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                    </ul>
                    <span class="navbar-text actions">
                        <a class="login" href="login.php">Log In</a>
                        <a class="btn btn-light action-button" role="button" href="index.php">Sign Up</a>
                    </span>
                </div>
            </div>
        </nav>
        <?php
        ?>
        <form action="consultaMultiple.php?pagina=0" method="POST">
            <h2 class="visually">Consulta Usuarios</h2>
            <div class="illustration">
                <div class="mb-3"><input class="form-control" type="text" name="EMAIL" placeholder="Email" value=""></div>
            </div>
            <div class="illustration">
                <div class="mb-3">
                    <select required name="PROVINCIA" class="form-control">
                        <option value="0">Elige Provincia</option>
                        <option value="ALAVA">Álava</option>
                        <option value="ALBACETE">Albacete</option>
                        <option value="ALICANTE">Alicante</option>
                        <option value="ALMERIA">Almería</option>
                        <option value="ASTURIAS">Asturias</option>
                        <option value="AVILA">Ávila</option>
                        <option value="BADAJOZ">Badajoz</option>
                        <option value="BALEARES">Baleares</option>
                        <option value="BARCELONA">Barcelona</option>
                        <option value="BURGOS">Burgos</option>
                        <option value="CACERES">Cáceres</option>
                        <option value="CADIZ">Cádiz</option>
                        <option value="CANTABRIA">Cantabria</option>
                        <option value="CASTELLON">Castellón</option>
                        <option value="CEUTA">Ceuta</option>
                        <option value="CIUDAD REAL">Ciudad Real</option>
                        <option value="CORDOBA">Córdoba</option>
                        <option value="CUENCA">Cuenca</option>
                        <option value="GERONA">Gerona</option>
                        <option value="GRANADA">Granada</option>
                        <option value="GUADALAJARA">Guadalajara</option>
                        <option value="GUIPUZCOA">Guipúzcoa</option>
                        <option value="HUELVA">Huelva</option>
                        <option value="HUESCA">Huesca</option>
                        <option value="JAEN">Jaén</option>
                        <option value="LA CORUÑA">La Coruña</option>
                        <option value="LA RIOJA">La Rioja</option>
                        <option value="LAS PALMAS">Las Palmas</option>
                        <option value="LEON">León</option>
                        <option value="LERIDA">Lérida</option>
                        <option value="LUGO">Lugo</option>
                        <option value="MADRID">Madrid</option>
                        <option value="MALAGA">Málaga</option>
                        <option value="MELILLA">Melilla</option>
                        <option value="MURCIA">Murcia</option>
                        <option value="NAVARRA">Navarra</option>
                        <option value="ORENSE">Orense</option>
                        <option value="PALENCIA">Palencia</option>
                        <option value="PONTEVEDRA">Pontevedra</option>
                        <option value="SALAMANCA">Salamanca</option>
                        <option value="SEGOVIA">Segovia</option>
                        <option value="SEVILLA">Sevilla</option>
                        <option value="SORIA">Soria</option>
                        <option value="TARRAGONA">Tarragona</option>
                        <option value="TENERIFE">Tenerife</option>
                        <option value="TERUEL">Teruel</option>
                        <option value="TOLEDO">Toledo</option>
                        <option value="VALENCIA">Valencia</option>
                        <option value="VALLADOLID">Valladolid</option>
                        <option value="VIZCAYA">Vizcaya</option>
                        <option value="ZAMORA">Zamora</option>
                        <option value="ZARAGOZA">Zaragoza</option>
                    </select>
                </div>
            </div>
            <div class="illustration">
                <div class="mb-3"><input class="form-control" type="text" name="NIF" placeholder="NIF" value=""></div>
            </div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Realizar consulta</button></div>
        </form>
    </section>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>''
</html>