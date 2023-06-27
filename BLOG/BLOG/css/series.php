<?php include("template/cabeza.php") ?>
<style>
    t {
        font-size: 16pt;
    }

    .btn {
        margin-right: 7px;
    }

    .botoniniciar {
        text-decoration: none;
        color: white;
    }

    .btn {
        position: relative;
        margin-left: 80px;
        margin-right: -50px;
    }

    .boton {
        color: white;
        /* border: none; */
        /* padding: 16px; */
        /* font-size: 18.5px; */
        cursor: pointer;
    }

    .links a {
        padding-left: 20px;
        text-decoration: none;
        color: white;
        display: block;
        padding: 13px;
    }

    .links {
        background-color: #212529;
        width: 105px;
        position: relative;
        left: 75px;
        display: none;
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .links a:hover {
        background-color: #0d6efd;
    }

    .desplegable:hover .links {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .desplegable {
        position: absolute;
        z-index: 999;
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
<div id="carouselE" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/fondo_series.webP" class="d-block w-100" alt="Imagen Ant-Man">
            <div class="carousel-caption">
                <h5 class="textserie">Series</h5>
            </div>
        </div>
    </div>
</div>
<section class="peliculas section-padding series">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-5">
                    <h2>Series</h2>
                    <p>En esta página verás diferentes secciones donde podrás informarte de los más recientes lanzamientos, las series clásicas del cine y los próximos lanzamientos ¡Esperamos que sea de tu agrado!</p>
                    <a href="#lo+mreciente" class="btn btn-primary mt-3 transUp">Lo mas reciente</a>
                    <a href="#clasicos" class="btn btn-primary mt-3 transUp">Clasicos</a>
                    <a href="#proximamente" class="btn btn-primary mt-3  transUp">Proximamente</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!----------------------------INICIO SERIES RECIENTES------------------------->
<section class="acerca section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-3 texto-serie-recientes texto-serie-recientes-dk">
                    <h2 id="lo+mreciente">Lo mas reciente</h2>
                    <p>¿Quieres descubrir nuevas películas que te encantarán? ¿Necesitas ayuda para encontrar una película en particular? ¿Te gustaría conocer las últimas novedades del cine? ¡Estás en el lugar correcto!</p>
                </div>
            </div>
        </div>
        <div class="row serie-reciente">

            <?php
            include("administrador/config/bd.php");
            $sentenciaSQL = $conexion->prepare("SELECT * FROM series_recientes ORDER by id desc LIMIT 12;");
            $sentenciaSQL->execute();
            $listapublicaciones = $sentenciaSQL
            ?>

            <?php foreach ($listapublicaciones as $publicaciones) { ?>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card-text-light text-center bg-dark pb-2 serie-reciente serie-reciente-dk">
                        <div class="card-body text-white">
                            <div class="img-area mb-4">
                                <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="img-fluid img-serie-reciente" alt="">
                            </div>
                            
                            <h3> <?php echo $publicaciones['titulo']; ?></h3>
                            <p class="lead">
                                <t><?php echo $publicaciones['comentario']; ?></t>
                            </p>
                            <?php
                            if (!empty($row["username"])) { ?>
                                <div class="desplegable">
                                    <button class="boton btn btn-primary mt-3 transUp">Ver series</button>
                                    <div class="links">
                                        <?php if (!empty($publicaciones['netflix'])) { ?>
                                            <a href="<?php echo $publicaciones['netflix']; ?>" target="_blank"> <img src="./assets/net.webP"> Netflix</a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['hbomax'])) { ?>
                                            <a href="<?php echo $publicaciones['hbomax']; ?>" target="_blank"><img src="./assets/hbomax.webP"> HboMax</a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['primevideo'])) { ?>
                                            <a href="<?php echo $publicaciones['primevideo']; ?>" target="_blank"><img src="./assets/primevid.webP"> Prime Video </a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['disney'])) { ?>
                                            <a href="<?php echo $publicaciones['disney']; ?>" target="_blank"><img src="./assets/disney.webP"> Disney+ </a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['star'])) { ?>
                                            <a href="<?php echo $publicaciones['star']; ?>" target="_blank"><img src="./assets/star.webP"> Star+ </a>
                                        <?php } ?>
                                        <?php if (!empty($publicaciones['crunchyroll'])) { ?>
                                            <a href="<?php echo $publicaciones['crunchyroll']; ?>" target="_blank"><img src="./assets/Crunchyroll.webP">Crunchyroll</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <button href="<?php echo $publicaciones['trailer']; ?>" class="btn btn-primary mt-3 transUp" target="_blank">Ver Trailer</button>
                            <?php } else { ?>
                                <a class="miBoton miBoton-2 btn btn-primary mt-3 transUp" target="_blank">Ver Pelicula</a>
                                <a class="miBoton miBoton-2 btn btn-primary mt-3 transUp" target="_blank">Ver Trailer</a>
                            <?php } ?>
                        </div>
                    </div>
                    <br>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!----------------------------FIN SERIES RECIENTES------------------------->

<!----------------------------INICIO SERIES CLASICAS------------------------->
<section class="acerca section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-3 texto-series-clasicas texto-series-clasicas-dk">
                    <h2 id="clasicos">Clasicos</h2>
                    <p>¿Quieres descubrir series antiguas, pero que siguen destacando hoy en día? ¿Te gustaría conocer de series que tuvieron gran impacto en el cine? ¡Estás en el lugar correcto!</p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php
            include("administrador/config/bd.php");
            $sentenciaSQL = $conexion->prepare("SELECT * FROM series_clasicas ORDER by id desc LIMIT 12;");
            $sentenciaSQL->execute();
            $listapublicaciones = $sentenciaSQL
            ?>
            <?php foreach ($listapublicaciones as $publicaciones) { ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card-text-light text-center bg-dark pb-2 series-clasicas series-clasicas-dk">
                        <div class="card-body text-white">
                            <div class="img-area mb-4">
                                <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="img-fluid img-serie-clasica" alt="">
                            </div>
                            <h3> <?php echo $publicaciones['titulo']; ?></h3>
                            <p class="lead">
                                <t><?php echo $publicaciones['comentario']; ?></t>
                            </p>
                            <?php
                            if (!empty($row["username"])) { ?>
                                <div class="desplegable">
                                    <button class="boton btn btn-primary mt-3 transUp">Ver series</button>
                                    <div class="links">
                                        <?php if (!empty($publicaciones['netflix'])) { ?>
                                            <a href="<?php echo $publicaciones['netflix']; ?>" target="_blank"> <img src="./assets/net.webP"> Netflix</a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['hbomax'])) { ?>
                                            <a href="<?php echo $publicaciones['hbomax']; ?>" target="_blank"><img src="./assets/hbomax.webP"> HboMax</a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['primevideo'])) { ?>
                                            <a href="<?php echo $publicaciones['primevideo']; ?>" target="_blank"><img src="./assets/primevid.webP"> Prime Video </a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['disney'])) { ?>
                                            <a href="<?php echo $publicaciones['disney']; ?>" target="_blank"><img src="./assets/disney.webP"> Disney+ </a>
                                        <?php } ?>

                                        <?php if (!empty($publicaciones['star'])) { ?>
                                            <a href="<?php echo $publicaciones['star']; ?>" target="_blank"><img src="./assets/star.webP"> Star+ </a>
                                        <?php } ?>
                                        <?php if (!empty($publicaciones['crunchyroll'])) { ?>
                                            <a href="<?php echo $publicaciones['crunchyroll']; ?>" target="_blank"><img src="./assets/Crunchyroll.webP"> Star+ </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <a href="<?php echo $publicaciones['trailer']; ?>" class="btn btn-primary mt-3 transUp" target="_blank">Ver Trailer</a>
                            <?php } else { ?>
                                <a class="miBoton miBoton-2 btn btn-primary mt-3 transUp" target="_blank">Ver Pelicula</a>
                                <a class="miBoton miBoton-2 btn btn-primary mt-3 transUp" target="_blank">Ver Trailer</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!----------------------------FIN SERIES CLASICAS------------------------->

<!----------------------------INICIO SERIES PROXIMAS------------------------->
<section class="acerca section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-3 texto-proximamente-series texto-proximamente-series-dk">
                    <h2 id="proximamente">Proximamente</h2>
                    <p>¿No conoces las próximas series que están por salir? ¿Quieres descubrir nuevos estrenos que te encantarán? ¿Estás ansioso por conocer los nuevos lanzamientos del cine? ¡Estás en el lugar correcto!</p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php
            include("administrador/config/bd.php");
            $sentenciaSQL = $conexion->prepare("SELECT * FROM series_proximas ORDER by id asc LIMIT 12;");
            $sentenciaSQL->execute();
            $listapublicaciones = $sentenciaSQL
            ?>

            <?php foreach ($listapublicaciones as $publicaciones) { ?>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card-text-light text-center bg-dark pb-2 proximas proximas-dk">
                        <div class="card-body text-white">
                            <div class="img-area mb-4">
                                <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="img-fluid img-serie-proximamente" alt="">
                            </div>
                            <h3> <?php echo $publicaciones['titulo']; ?></h3>
                            <p class="lead">
                                <t><?php echo $publicaciones['comentario']; ?></t>
                            </p>
                            <?php
                            if (!empty($row["username"])) { ?>
                                <a href="<?php echo $publicaciones['trailer']; ?>" class="btn btn-primary mt-3 transUp" target="_blank">Ver Trailer</a>
                            <?php } else { ?>

                                <a class="miBoton btn btn-primary mt-3" target="_blank transUp">Ver Trailer</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!----------------------------FIN SERIES PROXIMAS------------------------->

</body>

<?php include("template/pie.php") ?>