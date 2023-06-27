<?php
require '../config.php';
$_SESSION["time"] = '';

if (!empty($_SESSION["token"])) {
    $email = $_SESSION["email"];
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
} else {
    echo '<script language="javascript">
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Ingrese el codigo primero",
            text: "",
            confirmButtonColor: "#28a745",
            confirmButtonText: "OK",
        }).then(function() {
            window.location.href = "./verificacion.php";
        });
    });
  </script>';
}

if (!empty($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
} else {
    echo '<script language="javascript">
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Ingrese un email primero",
            text: "",
            confirmButtonColor: "#28a745",
            confirmButtonText: "OK",
        }).then(function() {
            window.location.href = "./recuperar_cuenta.php";
        });
    });
  </script>';
}

$accion = (isset($_POST['action'])) ? $_POST['action'] : "";
switch ($accion) {

    case "Cancelar":
        unset(
            $_SESSION["email"],
            $_SESSION["time"],
            $_SESSION["invalid"],
            $_SESSION["token"],
            $_SESSION["end_time"],
        );
        echo '<script language="javascript">alert("¿Estas seguro de salir? Si sales ahora no podras cambiar tu contraseña"); window.location="recuperar_cuenta.php";</script>';

        
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Ingrese el codigo primero",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./verificacion.php";
            });
        });
      </script>';
        break;
}
?>


<style>
    body {
        background-image: url(../assets/recuperar_contra.webP);
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
                <form method="post" autocomplete="off" action="sendemail.php">
                    <div class="form-group text-center pt-3">
                        <h1 class="text-light neon espacio">CAMBIAR CONTRASEÑA</h1>
                    </div>

                    <div class="form-group text-center pt-3">
                  
                    <?php if ($_SESSION["time"] <= '05:00') {
                        ?>
                            <div class="form-group text-center" id="response">
                                <h1 class="text-light tamaño"></h1>
                            </div>
                        <?php } ?>
                        

                        <?php
                        if ($_SESSION["invalid"] > '05:00') {
                            unset(
                                $_SESSION["time"],
                            );
                        ?>
                            <div class="alert alert-danger text-center">Código vencido</div>
                        <?php } ?>

                        <h1 class="text-light tamaño">Ingresa tu nueva contraseña</h1>

                    </div>

                    <div class="form-group mx-sm-4 pb-2">
                        <input type="password" id="pass" name="password" id="password" pattern="[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]{1,30}" value="" class="form-control text-light" placeholder="Ingrese su contraseña">

                    </div>

                    <div class="form-group mx-sm-4">

                        <input type="password" id="pass2" name="confirmpassword" pattern="[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]{1,30}" value="" class="form-control text-light" placeholder="Confirme su contraseña">

                    </div>

                    <div style="margin-right: 145px" class="form-group pb-2">
                        <input type="checkbox" id="muestrapassword" />&nbsp;&nbsp;Mostrar Contraseña
                    </div>

                    <div class="form-group mx-sm-4 pb-1">
                        <button type="sumbit" name="mandar" class="btn btn-block text-light btn-neon neon fuente">
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
</body>

</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<script type="text/javascript">
    setInterval(function() {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "res.php", false);
        xmlhttp.send(null);
        document.getElementById("response").innerHTML = xmlhttp.responseText;

    }, 1000);
</script>