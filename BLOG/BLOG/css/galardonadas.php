<?php include("template/cabeza.php") ?>

<!--CONECTA A LA BASE DE DATOS, RECOLECTANDO TODO (*) DE LA  RESPECTIVA TABLA EN DONDE TOMA LOS VALORES QUE CONTIENE EL ID Y LO GUARDA EN 
$listapublicaciones Y MEDIANTE EL FOREACH SE CICLA EL PROCESO, PERO SOLO TOMA EL VALOR DEL ID-->
<!--
    $sentenciaSQL = $conexion->prepare("SELECT * FROM inicio WHERE id=?");
    $sentenciaSQL->execute(); 
    $listapublicaciones = $sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
-->
<style>
    .carousel h5 {
        position: relative;
        top: -80px;
    }

    .navbar-brand {
        color: efff;
        font-size: 30px;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 2px;
    }
</style>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles-footer-pags.css">
</head>
<div class="carousel-indicators">
</div>
<div class="carousel-inner">
    <div class="carousel-item active">
        <img src="assets/image-oscars.webP" class="d-block w-100" alt="">
        <div class="carousel-caption carusel-galardonadas">
            <h5>Peliculas Galardonadas</h5>
        </div>
    </div>
</div>
</div>
<section class="galardonadas section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-5">
                    <h2>Galardonadas</h2>
                    <p>¡Hola a todos los amantes del cine! Bienvenidos a nuestra sección de noticias de la industria cinematográfica. En esta sección, encontrarán las últimas novedades sobre películas, actores, directores y todo lo relacionado con el mundo del cine.
                        <br>
                        Desde rumores de casting hasta avances exclusivos de películas que pronto llegarán a los cines, nuestro equipo de redactores expertos en cine les traerá la información más relevante y actualizada.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="acerca seccion-padding">
    <div class="container">
        <div class="row">

            <?php
            include("administrador/config/bd.php");
            $sentenciaSQL = $conexion->prepare("SELECT * FROM galardonadas ORDER by id desc LIMIT 24;");
            $sentenciaSQL->execute();
            $listapublicaciones = $sentenciaSQL
            ?>

            <?php foreach ($listapublicaciones as $publicaciones) {  ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card-text-light text-center bg-dark pb-2 pelis-galardonadas-dk pelis-galardonadas">
                        <div class="card-body text-white">
                            <div class="img-area mb-4">
                                <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="img-fluid" width="450" alt="">
                            </div>
                            <button class="boton-fecha btn btn-warning"> <?php echo $publicaciones['fecha']; ?> </button>
                            <h3><?php echo $publicaciones['titulo']; ?></h3>
                            <p style="line-height:1.7;" class="lead">
                                <t><?php echo $publicaciones['comentario']; ?></t>
                            </p>
                            <?php
                            if (!empty($row["username"])) { ?>
                                <a href="<?php echo $publicaciones['presentacion']; ?>" class="btn btn-primary mt-3 transUp" target="_blank">Ver presentacion</a>
                            <?php } else { ?>

                                <a class="miBoton btn btn-primary mt-3 transUp" target="_blank">Ver Presentacion</a>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>


<?php include("template/pie.php") ?>