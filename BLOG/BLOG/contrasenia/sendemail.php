<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

require '../config.php';
$token = rand(100000, 999999);

if (isset($_POST['Enviar'])) {
    $email_del_user = ($_POST["email_del_user"]);
    $email_del_user = strtolower($email_del_user);
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email_del_user'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $fecha_actual = date("Y-m-d h:m:s");
        $fecha_actual = strtotime($fecha_actual);
        $_SESSION["email"] = $email_del_user;
        $_SESSION["email"] = $email_del_user ?? 'sin valor';
        $result = mysqli_query($conn, "UPDATE usuarios SET token=$token WHERE email='$email_del_user'");
        $_SESSION["time"] = '';
        $_SESSION["invalid"] = '';
        $link = mysqli_connect("localhost", "root", "");
        mysqli_select_db($link, "admin");
        $duration = "";
        $res = mysqli_query($link, "select * from tiempo_token");
        while ($time = mysqli_fetch_array($res)) {
            $duration = $time["duration"];
        }
        $_SESSION["duration"] = $duration;
        $_SESSION["star_time"] = date("Y-m-d H:i:s");
        $end_time = $end_time = date('Y-m-d H:i:s', strtotime('+' . $_SESSION["duration"] . 'minutes', strtotime($_SESSION["star_time"])));
        $_SESSION["end_time"] = $end_time;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'equipocinehub@gmail.com';
        $mail->Password = 'ugafqhdwrggdznwm';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = '465';
        $mail->setFrom('equipocinehub@gmail.com');
        $mail->addAddress($email_del_user);
        $mail->isHTML(true);
        $mail->Subject = 'Recuperacion de cuenta de Cine-Hub';
        $mensaje = '
<html>
<head>
    <meta charset="UTF8" />
</head>
<body>
  <p>tu codigo de verificacion es :' . $token . '</p>
  <p> <a href="http://localhost/BLOG/contrasenia/verificacion.php' . '">
    Verificar cuenta </a> 
    </p>  
</body>
</html>
';
        $mail->Body = ($mensaje);
        $mail->send();

        echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Código de Verificacion enviado a su correo",
                    text: "",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "./verificacion.php";
                });
            });
          </script>';
    } else if (empty($_POST["email_del_user"])) {
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Ingrese un correo primero",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./recuperar_cuenta.php";
            });
        });
      </script>';
    } else {
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Correo no registrado",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./recuperar_cuenta.php";
            });
        });
      </script>';
    }
}
if (isset($_POST['Send'])) {
    if (empty($_SESSION["time"])) {
        unset(
            $_SESSION["email"],
            $_SESSION["invalid"],
            $_SESSION["token"],
            $_SESSION["end_time"],
        );
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "El codigo expiró, por favor intentelo de nuevo",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./recuperar_cuenta.php";
            });
        });
      </script>';
    } else {

        $token = $_POST["token"];
        $_SESSION["token"] = $_POST["token"];
        $result = $conne->prepare("SELECT * FROM usuarios WHERE token = ? AND email = ?");
        $result->execute([$token, $_SESSION['email']]);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if ($token == $row["token"]) {
                echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Código de Verificacion correcto",
                    text: "",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "./cambiar_contra.php";
                });
            });
          </script>';
            }
        } else if (empty($_POST["token"])) {
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
        } else {
            echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Codigo incorrecto",
                    text: "",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "./verificacion.php";
                });
            });
          </script>';
        }
    }
}

if (isset($_POST['mandar'])) {

    if (empty($_SESSION["time"])) {
        unset(
            $_SESSION["email"],
            $_SESSION["time"],
            $_SESSION["invalid"],
            $_SESSION["token"],
            $_SESSION["end_time"],
        );
        echo '<script language="javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "El codigo expiró, por favor intentelo de nuevo",
                text: "",
                confirmButtonColor: "#28a745",
                confirmButtonText: "OK",
            }).then(function() {
                window.location.href = "./recuperar_cuenta.php";
            });
        });
      </script>';
    } else {
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        if (empty($_POST["password"])) {
            echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Ingrese la contraseña primero",
                    text: "",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "./cambiar_contra.php";
                });
            });
          </script>';
        } else if (empty($_POST["confirmpassword"])) {
            echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Confirme su contraseña primero",
                    text: "",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "./cambiar_contra.php";
                });
            });
          </script>';
        } else if ($password == $confirmpassword) {
            $encriptar = password_hash($password, PASSWORD_DEFAULT);
            $result = $conne->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
            $result->execute([$encriptar, $_SESSION["email"]]);
            echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Contraseña cambiada con exito",
                    text: "",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "../login.php";
                });
            });
          </script>';
        } else {
            echo '<script language="javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Las contraseñas no coinciden",
                    text: "",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "OK",
                }).then(function() {
                    window.location.href = "./cambiar_contra.php";
                });
            });
          </script>';
        }
    }
}
?>
<link rel="shortcut icon" href="../assets/logo2.webP">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>