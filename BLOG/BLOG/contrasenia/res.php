<?php
require '../config.php';

if (!empty($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
    $from_time1 = date('Y-m-d H:i:s');

    $to_time1 = $_SESSION["end_time"];

    $time_first = strtotime($from_time1);

    $time_second = strtotime($to_time1);

    $difference = $time_second - $time_first;

    $time_lapse = gmdate("i:s", $difference);

    $_SESSION["time"] = $time_lapse;


    if ($_SESSION["time"] <= '05:00') {
        echo $_SESSION["time"];
    } else {

        $_SESSION["invalid"] = $time_lapse;
        unset(
            $_SESSION["time"],
        );
    }
}
?>