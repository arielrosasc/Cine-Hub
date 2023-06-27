<?php
require 'config.php';

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

if (isset($_POST["add"])) {
    $rating = $_POST["rating"];
    $verify_review = $conne->prepare("SELECT * FROM rate_peliculas WHERE post_id = ? AND user_id = ?");
    $verify_review->execute([$_SESSION["post_id"], $user_id]);
    if ($verify_review->rowCount() > 0) {
        $update_review = $conne->prepare("UPDATE rate_peliculas SET rate = ? WHERE post_id = ? AND user_id = ?");
        $update_review->execute([$rating, $_SESSION["post_id"], $user_id]);
        $update_peliculas = $conn->prepare("UPDATE reseñas_peliculas SET rate = ? WHERE id = ? ");
        $update_peliculas->execute([round($_SESSION["promedio"]), $_SESSION["post_id"]]);
        echo '<script language="javascript">window.location="reseñas.php#peliculas";</script>';
//         echo '<script language="javascript">
//         document.addEventListener("DOMContentLoaded", function() {
//         Swal.fire({
//             icon: "success",
//             title: "Su calificación se agregó correctamente",
//             text: "",
//             confirmButtonColor: "#28a745",
//             confirmButtonText: "OK",
//         }).then(function() {
//             window.location.href = "reseñas.php#peliculas";
//         });
//     });
//   </script>';
    } else {
        $add_review = $conn->prepare("INSERT INTO rate_peliculas (id, post_id, user_id, rate) VALUES(?,?,?,?)");
        $add_review->execute(['', $_SESSION["post_id"], $user_id, $rating]);
        $update_peliculas = $conn->prepare("UPDATE reseñas_peliculas SET rate = ? WHERE id = ? ");
        $update_peliculas->execute([round($_SESSION["promedio"]), $_SESSION["post_id"]]);
        echo '<script language="javascript">window.location="reseñas.php#peliculas";</script>';
//         echo '<script language="javascript">
//         document.addEventListener("DOMContentLoaded", function() {
//         Swal.fire({
//             icon: "success",
//             title: "Su calificación se actualizó correctamente",
//             text: "",
//             confirmButtonColor: "#28a745",
//             confirmButtonText: "OK",
//         }).then(function() {
//             window.location.href = "reseñas.php#peliculas";
//         });
//     });
//   </script>';
    }
}

if (isset($_POST["add_series"])) {
    $rating = $_POST["rating_series"];
    $verify_review = $conne->prepare("SELECT * FROM rate_series WHERE post_id = ? AND user_id = ?");
    $verify_review->execute([$_SESSION["post_id_series"], $user_id]);
    if ($verify_review->rowCount() > 0) {
        $update_review = $conne->prepare("UPDATE rate_series SET rate = ? WHERE post_id = ? AND user_id = ?");
        $update_review->execute([$rating, $_SESSION["post_id_series"], $user_id]);
        echo '<script language="javascript">window.location="reseñas.php#series";</script>';
//         echo '<script language="javascript">
//         document.addEventListener("DOMContentLoaded", function() {
//         Swal.fire({
//             icon: "success",
//             title: "Su calificación se actualizó correctamente",
//             text: "",
//             confirmButtonColor: "#28a745",
//             confirmButtonText: "OK",
//         }).then(function() {
//             window.location.href = "reseñas.php#series";
//         });
//     });
//   </script>';
    } else {
        $add_review = $conn->prepare("INSERT INTO rate_series (id, post_id, user_id, rate) VALUES(?,?,?,?)");
        $add_review->execute(['', $_SESSION["post_id_series"], $user_id, $rating]);
        echo '<script language="javascript">window.location="reseñas.php#series";</script>';
//         echo '<script language="javascript">
//         document.addEventListener("DOMContentLoaded", function() {
//         Swal.fire({
//             icon: "success",
//             title: "Su calificación se agregó correctamente",
//             text: "",
//             confirmButtonColor: "#28a745",
//             confirmButtonText: "OK",
//         }).then(function() {
//             window.location.href = "reseñas.php#series";
//         });
//     });
//   </script>';
    }
}
?>
<link rel="shortcut icon" href="assets/logo2.webP">