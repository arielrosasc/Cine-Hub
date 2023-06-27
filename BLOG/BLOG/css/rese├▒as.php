<?php include("template/cabeza.php");
include("administrador/config/bd.php");
?>

<style>
    t {
        font-size: 21px;

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
            <img src="assets/fondo_reseñas.webP" class="d-block w-100" alt="">
            <div class="carousel-caption">
                <h5 class="textreseña">Reseñas</h5>
            </div>
        </div>
    </div>
</div>
<section class="peliculas section-padding reseñas">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-5 texto-reseñas texto-reseñas-dk">
                    <h2>Reseñas</h2>
                    <p>Compartimos nuestra opinión respecto a diferentes entregas en el mundo del cine, siempre desde el máximo respeto y donde usted puede expresar lo que opina de éstas calificándonos con las estrellas.</p>
                    <a href="#peliculas" class="btn btn-primary mt-3 transUp">Peliculas</a>
                    <a href="#series" class="btn btn-primary mt-3 transUp">Series</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!----------------------------SECCION PELICULAS------------------------->
<section class="acerca section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-3 texto-reseñas-peliculas texto-reseñas-peliculas-dk">
                    <h2 id="peliculas">PELICULAS</h2>
                    <p>
                        ¿No sabes qué pelicula ver? ¿Te gustaría conocer la opinión, de diferentes entregas del cine, de expertos en el tema? ¡Estás en el lugar correcto!
                    </p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php
            $sentenciaSQL = $conexion->prepare("SELECT * FROM reseñas_peliculas ORDER by id desc LIMIT 12;");
            $sentenciaSQL->execute();
            $listapublicaciones = $sentenciaSQL;

            foreach ($listapublicaciones as $publicaciones) {
                $post_id = $publicaciones["id"];
                $_SESSION["post_id"] = $post_id;
                $_SESSION["post_id"] = $post_id ?? $post_id;

            ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card-text-light text-center bg-dark pb-2 reseñas-peliculas reseñas-peliculas-dk">
                        <div class="card-body text-white">
                            <div class="img-area mb-4">
                                <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="img-fluid img-reseñas-peliculas" alt="">
                            </div>
                            <h3><?php echo $publicaciones['titulo']; ?></h3>
                            <p style="line-height:1.58;" class="lead">
                                <t><?php echo $publicaciones['comentario']; ?> </t>
                            </p>
                            <form method="post" action="dobled.php">
                                <input type="hidden" name="idMedia" value="<?php echo $publicaciones["id"] ?>" />
                                <?php
                                $select_post = $conne->prepare("SELECT * FROM reseñas_peliculas WHERE id = ? LIMIT 12");
                                $select_post->execute([$post_id]);
                                if ($select_post->rowCount() > 0) {
                                    while ($fetch_post = $select_post->fetch(PDO::FETCH_ASSOC)) {
                                        $total_ratings = 0;
                                        $select_ratings = $conne->prepare("SELECT * FROM rate_peliculas WHERE post_id = ?");
                                        $select_ratings->execute([$fetch_post['id']]);
                                        $total_reivews = $select_ratings->rowCount();

                                        while ($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)) {
                                            $total_ratings += $fetch_rating['rate'];
                                        }
                                        if ($total_reivews != 0) {
                                            $average = round($total_ratings / $total_reivews, 1);
                                        } else {
                                            $average = 0;
                                        }
                                        $_SESSION["promedio_peliculas"] = $average;
                                        if (!empty($row["username"])) {
                                ?>
                                            <div class="promedio-estrellas">
                                                <h5>Usuarios</h5>
                                                <h4>
                                                    <?= $average; ?>/5
                                                    <i class="fa-solid fa-star fa-fade fa-md" style="color: #fbff00;"></i>
                                                </h4>
                                            </div>

                                            <div class="containerstar">
                                                <div class="rating">
                                                    <input type="radio" value="5" name="rating" style="--c:#FFFF00">
                                                    <input type="radio" value="4" name="rating" style="--c:#FFFF00">
                                                    <input type="radio" value="3" name="rating" style="--c:#FFFF00">
                                                    <input type="radio" value="2" name="rating" style="--c:#FFFF00">
                                                    <input type="radio" value="1" name="rating" style="--c:#FFFF00">
                                                </div>
                                            </div>
                                            <div class="info-estrellas">
                                                <button name="add" class="btn btn-primary transUp">Calificar</button>
                                                <h5><?= $total_reivews; ?> Reviews</h5>
                                            </div>
                            </form>
                <?php }
                                    }
                                }
                ?>

                <?php if (empty($row["username"])) { ?>
                    <div class="promedio-estrellas">
                        <h5>Usuarios</h5>
                        <h4>
                            <?= $average; ?>/5
                            <i class="fa-solid fa-star fa-fade fa-md" style="color: #fbff00;"></i>
                        </h4>
                    </div>
                    <div class="rating">
                        <div class="containerstar">
                            <input class="miBoton" type="radio" value="1" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="2" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="3" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="4" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="5" name="clr1" style="--c:#FFFF00">
                        </div>
                    </div>

                    <div class="info-estrellas">
                        <button class="miBoton btn btn-primary transUp">Calificar</button>
                        <h5><?= $total_reivews; ?> Reviews</h5>
                    </div>

                <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!----------------------------SECCION SERIES------------------------->
<section class="acerca section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center text-white pb-3 texto-reseñas-series texto-reseñas-series-dk">
                    <h2 id="series">Series</h2>
                    <p>¿No sabes qué serie ver? ¿Te gustaría conocer la opinión, de diferentes entregas del cine, de expertos en el tema? ¡Estás en el lugar correcto!</p>
                </div>
            </div>
        </div>
        <div class="row">
        <?php
            $sentenciaSQL = $conexion->prepare("SELECT * FROM reseñas_series ORDER by id desc LIMIT 12;");
            $sentenciaSQL->execute();
            $listapublicaciones = $sentenciaSQL;
            foreach ($listapublicaciones as $publicaciones) {
                $post_id_series = $publicaciones["id"];
                $_SESSION["post_id_series"] = $post_id_series;
                $_SESSION["post_id_series"] = $post_id_series ?? $post_id_series;
            ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card-text-light text-center bg-dark pb-2 reseñas-series reseñas-series-dk">
                        <div class="card-body text-white">
                            <div class="img-area mb-4">
                                <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="img-fluid img-reseñas-series" alt="">
                            </div>
                            <h3><?php echo $publicaciones['titulo']; ?></h3>
                            <p class="lead">
                                <t><?php echo $publicaciones['comentario']; ?> </t>
                            </p>
                            <form method="post" action="dobled.php">
                                <input type="hidden" name="idMedia" value="<?php echo $publicaciones["id"] ?>" />
                                <?php
                                $select_post = $conne->prepare("SELECT * FROM reseñas_series WHERE id = ? LIMIT 12");
                                $select_post->execute([$post_id_series]);
                                if ($select_post->rowCount() > 0) {
                                    while ($fetch_post = $select_post->fetch(PDO::FETCH_ASSOC)) {
                                        $total_ratings = 0;
                                        $select_ratings = $conne->prepare("SELECT * FROM rate_series WHERE post_id = ?");
                                        $select_ratings->execute([$fetch_post['id']]);
                                        $total_reivews = $select_ratings->rowCount();
                                        while ($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)) {
                                            $total_ratings += $fetch_rating['rate'];
                                        }
                                        if ($total_reivews != 0) {
                                            $average = round($total_ratings / $total_reivews, 1);
                                        } else {
                                            $average = 0;
                                        }
                                        $_SESSION["promedio_series"] = $average;
                                        if (!empty($row["username"])) { ?>
                                            <div class="promedio-estrellas">
                                                <h5>Usuarios</h5>
                                                <h4>
                                                    <?= $average; ?>/5
                                                    <i class="fa-solid fa-star fa-fade fa-md" style="color: #fbff00;"></i>
                                                </h4>
                                            </div>
                                            <div class="containerstar">
                                                <div class="rating">
                                                    <input type="radio" value="5" name="rating_series" style="--c:#FFFF00">
                                                    <input type="radio" value="4" name="rating_series" style="--c:#FFFF00">
                                                    <input type="radio" value="3" name="rating_series" style="--c:#FFFF00">
                                                    <input type="radio" value="2" name="rating_series" style="--c:#FFFF00">
                                                    <input type="radio" value="1" name="rating_series" style="--c:#FFFF00">
                                                </div>
                                            </div>
                                            <div class="info-estrellas">
                                                <button name="add_series" class="btn btn-primary transUp">Calificar</button>
                                                <h5><?= $total_reivews; ?> Reviews</h5>
                                            </div>
                            </form>
                <?php }
                                    }
                                }
                ?>
                <?php if (empty($row["username"])) { ?>
                    <div class="promedio-estrellas">
                        <h5>Usuarios</h5>
                        <h4>
                            <?= $average; ?>/5
                            <i class="fa-solid fa-star fa-fade fa-md" style="color: #fbff00;"></i>
                        </h4>
                    </div>
                    <div class="rating">
                        <div class="containerstar">
                            <input class="miBoton" type="radio" value="1" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="2" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="3" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="4" name="clr1" style="--c:#FFFF00">
                            <input class="miBoton" type="radio" value="5" name="clr1" style="--c:#FFFF00">
                        </div>
                    </div>
                    <div class="info-estrellas">
                        <button name="add" class="miBoton btn btn-primary transUp">Calificar</button>
                        <h5><?= $total_reivews; ?> Reviews</h5>
                    </div>
                <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
</body>

<?php include("template/pie.php") ?>