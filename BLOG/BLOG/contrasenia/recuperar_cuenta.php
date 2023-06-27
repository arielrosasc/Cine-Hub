<?php
require '../config.php';

$accion = (isset($_POST['action'])) ? $_POST['action'] : "";
switch ($accion) {
    case "Cancelar":
        echo '<script language="javascript">window.location="../login.php";</script>';
        break;
}
$_SESSION["invalid"] = '';

?>

<style>
    body {
        background-image: url(../assets/recuperar_cuenta.webP);
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <link rel="stylesheet" href="css/getpass_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/logo2.webP">
    <title> Cine-Hub </title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center pt-5 mt-5 mr-1 ">
            <div class="col-md-4 formulario neon2">
                <div class="form-group text-center pt-3">
                    <h1 class="text-light neon espacio">RECUPERA TU CUENTA</h1>
                </div>
                <form action="sendemail.php" method="post">
                    <div class="form-group text-center pt-3">
                        <h1 class="text-light tamaño">Ingresa tu correo o número de celular para buscar tu cuenta</h1>
                    </div>

                    <div class="form-group mx-sm-4 pb-3">
                        <input type="email" name="email_del_user" class="form-control text-light" placeholder="Ingrese su email">
                    </div>

                    <div class="form-group mx-sm-4 pb-1">
                        <button type="sumbit" name="Enviar" value="Enviar" class="btn btn-block text-light btn-neon neon fuente">
                            <span id="span1"></span>
                            <span id="span2"></span>
                            <span id="span3"></span>
                            <span id="span4"></span>
                            ENVIAR
                        </button>
                    </div>
                </form>

                <form method="post">
                    <div class="form-group mx-sm-4 pb-1">
                        <button type="sumbit" name="action" value="Cancelar" class="btn btn-block text-light btn-neon neon fuente">
                            <span id="span1"></span>
                            <span id="span2"></span>
                            <span id="span3"></span>
                            <span id="span4"></span>
                            CANCELAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>