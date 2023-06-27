<?php
 try {
    $conexion = new PDO('mysql:host=localhost;dbname=admin','root','');
    }
    catch (Exception $ex){
	echo $ex->getMessage();
}
?>