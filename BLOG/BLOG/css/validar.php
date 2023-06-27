<?php
require 'config.php';
include("administrador/config/bd.php");

if (!empty($_SESSION["id"])) {
    $user_id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id=$user_id");
    $row = mysqli_fetch_assoc($result);
} else {
    unset(
        $_SESSION["id"],
    );
    header("Location:");
}

if (isset($_POST['mensaje'])) {
    $comentario = htmlspecialchars($_POST['mensaje'], ENT_QUOTES); // se aplica htmlspecialchars() al valor introducido en el campo de "mensaje" para evitar xss
    file_put_contents("comentarios.txt", $comentario, FILE_APPEND);
    file_get_contents("comentarios.txt", true);

    if (isset($_POST['envioemail'])) {
        if (($_POST['usuario']) >= 1 && ($_POST['email']) >= 1 && ($_POST['mensaje']) >= 1) {
            $name = ($_POST['usuario']);
            $email = ($_POST['email']);
            $fecha = date("d/m/y");
            $sentenciaSQL = $conexion->prepare("INSERT INTO correo (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje);");
            $sentenciaSQL->bindParam(':nombre', $name);
            $sentenciaSQL->bindParam(':email', $email);
            $sentenciaSQL->bindParam(':mensaje', $comentario);
            $sentenciaSQL->execute();
        }
    }
    $rating = $_POST["rating_blog"];
    $verify_review = $conne->prepare("SELECT * FROM rate_blog WHERE user_id = ?");
    $verify_review->execute([$user_id]);
    if ($verify_review->rowCount() > 0) {
        $update_review = $conne->prepare("UPDATE rate_blog SET rate = ? WHERE user_id = ?");
        $update_review->execute([$rating, $user_id]);
    } else {
        $add_review = $conn->prepare("INSERT INTO rate_blog (id, user_id, rate) VALUES(?,?,?)");
        $add_review->execute(['', $user_id, $rating]);
    }
    echo '<script language="javascript">
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "success",
            title: "Opinion enviada exitosamente",
            text: "",
            confirmButtonColor: "#28a745",
            confirmButtonText: "OK",
        }).then(function() {
            window.location.href = "./index.php#email";
        });
    });
  </script>';
}
?>
<link rel="shortcut icon" href="assets/logo2.webP">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>