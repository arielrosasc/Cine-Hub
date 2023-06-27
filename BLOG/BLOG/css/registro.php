<?php
require 'config.php';

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate_user = mysqli_query($conn, "SELECT * FROM  usuarios WHERE BINARY username = '$username'");
    $duplicate_email = mysqli_query($conn, "SELECT * FROM  usuarios WHERE email = '$email'");
    $email = strtolower($email);

    if (mysqli_num_rows($duplicate_user) > 0) {
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Nombre de usuario ya existe",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./registro.php";
            });
        });
      </script>';
    } else if (mysqli_num_rows($duplicate_email) > 0) {
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Correo ya utilizado",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./registro.php";
            });
        });
      </script>';
    } else if ($password == $confirmpassword) {
        $encriptar = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios VALUES('$id', '$username', '$email', '$encriptar', '3', '')";
        mysqli_query($conn, $query);
        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE BINARY username = '$username'");
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location:index.php");
        }
    } else {
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "La contraseña no es la misma",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./registro.php";
            });
        });
      </script>';
    }
}
// $aes_256_cbc = "AES-256-CBC";
// $encriptar = "aes-256-cbc";
// $iv_size = openssl_cipher_iv_length($encriptar);
// $iv = openssl_random_pseudo_bytes($iv_size);
// $metodo = "aes-256-cbc";
// $encriptar = $password;
// $encriptar2 = $confirmpassword;
// $key = "llave";
// $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
// $contraencriptar = openssl_encrypt($encriptar, $metodo, $key, 0, $iv);
// $contraencriptar2 = openssl_encrypt($encriptar2, $metodo, $key, 0, $iv);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/sticky-footer-navbar.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link rel="shortcut icon" href="assets/logo2.webP">
    <title> Cine-Hub </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <style>
        body {

            background-image: url(assets/fondo_registro.webP);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center pt-5 mt-3 mr-1">
            <div class="col-md-4 formulario">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group text-center pt-3">
                        <h1 class="text-light neon espacio">REGISTRATE</h1>
                    </div>
                    <div class="form-group mx-sm-4 pt-3">
                        <input type="text" name="username" pattern="[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]{1,30}" required value="" class="form-control text-light" placeholder="Ingrese su usuario">
                    </div>
                    <div class="form-group mx-sm-4 pb-1">
                        <input type="email" name="email" id="email" required value="" class="form-control text-light" placeholder="Ingrese su email">
                    </div>

                    <div class="form-group mx-sm-4 pb-2">

                        <input type="password" id="pass" name="password" id="password" pattern="[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]{1,30}" required value="" class="form-control text-light" placeholder="Ingrese su contraseña">

                    </div>

                    <div class="form-group mx-sm-4">

                        <input type="password" id="pass2" name="confirmpassword" pattern="[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]{1,30}" required value="" class="form-control text-light" placeholder="Confirmar contraseña">

                    </div>
                    <div style="margin-right: 145px" class="form-group pb-2">
                        <input type="checkbox" id="muestrapassword" />&nbsp;&nbsp;Mostrar Contraseña
                    </div>

                    <div class="form-group mx-sm-4 pb-3">
                        <button type="submit" name="submit" class="btn btn-block text-light btn-neon neon fuente">
                            <span id="span1"></span>
                            <span id="span2"></span>
                            <span id="span3"></span>
                            <span id="span4"></span>
                            REGISTRARSE
                        </button>
                    </div>
                    <div class="form-group mx-sm-4 text-center">
                        <span class="text-left"><a href="login.php" class="text-primary olvide neon">¿Ya tienes cuenta? (Inicia sesión)</a></span>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#muestrapassword').click(function() {
            var defType = 'password';
            if ($('#muestrapassword').is(':checked')) {
                defType = 'text';
            }
            $('#pass2').attr('type', defType);
        });
    });
    $(document).ready(function() {
        $('#muestrapassword').click(function() {
            var defType = 'password';
            if ($('#muestrapassword').is(':checked')) {
                defType = 'text';
            }
            $('#pass').attr('type', defType);
        });
    })
</script>