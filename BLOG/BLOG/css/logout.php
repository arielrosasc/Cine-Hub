<?php
    require 'config.php';
    unset(
        $_SESSION["id"],
        $_SESSION["post_id"],
        $_SESSION["post_id_series"],
    );

    header("Location:login.php");
