<?php include("template/cabeza.php") ?>
<style>
    .btn {
        margin-right: 7px;
    }

    .botoniniciar {
        text-decoration: none;
        color: white;
    }

    .btn {
        position: relative;
        margin-left: 50px;
        margin-right: -50px;
    }

    .boton {
        color: white;
        /* border: none; */
        /* padding: 16px;
    font-size: 18.5px; */
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
        left: 60px;
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
    }

    .btn {
        margin-left: auto;
        margin-right: auto;
    }
</style>




<div id="carouselE" class="carousel slide" data-bs-ride="carousel">
    <?php
    include("administrador/config/bd.php");
    $sentenciaSQL = $conexion->prepare("SELECT * FROM inicio ORDER by id asc LIMIT 12;");
    $sentenciaSQL->execute();
    $listapublicaciones = $sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
    $primero = 1;
    $limite = 0;
    ?>
    <div class="carousel-inner">

        <?php foreach ($listapublicaciones as $publicaciones) {
            $limite++; ?>
            <?php if ($primero == 1) {
                $primero = 0; ?>

                <div class="carousel-item active">
                    <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="d-block w-100" alt="">
                    <div class="carousel-caption">
                        <br><br><br><br>
                        <h5 class="card-title"><?php echo $publicaciones['titulo']; ?></h5>
                        <a href="<?php echo $publicaciones['href']; ?>" class="btn btn-primary mt-3 transUp">Mas informacion</a>
                    </div>


                <?php } else { ?>
                    <div class="carousel-item">
                        <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="d-block w-100" alt="">
                        <div class="carousel-caption">
                            <br><br><br><br>
                            <h5 class="card-title"><?php echo $publicaciones['titulo']; ?></h5>
                            <a href="<?php echo $publicaciones['href']; ?>" class="btn btn-primary mt-3 transUp">Mas informacion</a>
                        </div>
                    <?php } ?>
                    </div>
                <?php } ?>
                </div>

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselE" data-bs-slide-to="0" class="active" aria-current="true">
                    </button>


                    <?php for ($carrusel = 1; $carrusel < $limite; $carrusel++) { ?>
                        <button type="button" data-bs-target="#carouselE" data-bs-slide-to="<?php echo $carrusel ?>" aria-current="true"></button>
                    <?php } ?>


                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselE" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselE" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

    </div>
    <section class="about section-padding"> <!--"section-padding": es una clase que puede ser utilizada para agregar un relleno uniforme alrededor de un elemento, lo que ayuda a crear un espaciado consistente en una página web. -->
        <div class="container">
            <div class="row"> <!--"row": se utiliza como un contenedor para las columnas dentro de una sección de la página web.lo que significa que las columnas dentro de una fila se ajustarán automáticamente para adaptarse al ancho de la pantalla del dispositivo en el que se visualiza la página-->
                <div class="col-lg-4 col-md-12 col-12"> <!-- este conjunto de clases de columna significa que la columna ocupará todo el ancho de la fila en pantallas medianas y pequeñas, pero ocupará 4 unidades de ancho en pantallas grandes. Esto es útil para crear diseños que se adapten a diferentes tamaños de pantalla -->
                    <div class="about-img">
                        <img src="assets/logocine4.webP" class="img-fluid" alt=""> <!-- "img-fluid": se utiliza para hacer que las imágenes se adapten al ancho del contenedor que las contiene. -->
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5"> <!-- ps-lg-5 mt-md-5: Estas clases de espaciado son útiles para ajustar el diseño de una página web, agregando un espacio adicional entre los elementos para mejorar la legibilidad y la organización del contenido-->
                    <div class="about-text text-white">
                        <a class="navbar-brand"> <span class="text-primary ">CINE</span>-HUB</a>
                        <p>
                            ¡Hola! Bienvenido/a Cine-Hub. Si eres un amante del cine, estás en el lugar indicado. Aquí encontrarás reseñas, críticas y recomendaciones de las últimas películas estrenadas en cartelera, así como clásicos que han dejado huella en la historia del cine.

                            Nuestro objetivo es compartir mi pasión por el séptimo arte y brindarte una guía confiable para que puedas elegir qué películas ver en función de tus gustos e intereses. Además, también abordaré temas relacionados con la industria cinematográfica, como festivales, premiaciones y tendencias.

                            Espero que disfrutes de este espacio y te animes a participar en los comentarios para compartir tus opiniones y recomendaciones. ¡Vamos al cine!
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="services section-padding"> <!--"section-padding": es una clase que se utiliza para aplicar un espaciado uniforme alrededor del contenido de una sección, con el fin de mejorar la legibilidad y la organización del contenido-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center text-white pb-5">
                        <h2>Nuestros servicios</h2>
                        <p>¿Quieres descubrir nuevas películas que te encantarán? ¿Necesitas ayuda para encontrar una película en particular? ¿Te gustaría conocer las últimas novedades del cine? ¡Estás en el lugar correcto!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2 pelis">
                        <div class="card-body peli"> <!--  proporciona un relleno predeterminado de 1.25rem al contenido que contiene, lo que ayuda a crear una separación entre el contenido y el borde de la tarjeta-->
                            <i class="bi bi-camera-reels"></i>
                            <h3 class="card-title">Peliculas</h3>
                            <p style="line-height:1.4;" class="lead">
                                En esta sección encontrarás todo lo que necesitas saber sobre las películas más emocionantes del momento. ¿Quieres saber qué películas han ganado premios este año? ¿O quizás estás buscando algo nuevo y emocionante para ver este fin de semana? No importa lo que estés buscando, tenemos todo lo que necesitas aquí en nuestra sección de películas.
                            </p>
                            <br>
                            <a href="peliculas.php" class="btn bg-primary text-white transUp">Mas informacion</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2 reseñas">
                        <div class="card-body">
                            <i class="bi bi-clipboard-data"></i>
                            <h3 class="card-title">Reseñas</h3>
                            <p class="lead">
                                En nuestra sección de reseñas encontrarás críticas detalladas y objetivas de las últimas producciones cinematográficas, así como de clásicos inolvidables que han dejado huella en la historia del cine. Nos aseguramos de proporcionarte las mejores recomendaciones para que puedas disfrutar de una experiencia completa y satisfactoria.
                            </p>
                            <a href="reseñas.php" class="btn bg-primary text-white transUp">Mas informacion</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2 notis">
                        <div class="card-body noti">
                            <i class="bi bi-card-text"></i>
                            <h3 class="card-title">Noticias</h3>
                            <p class="lead">
                                En nuestra sección de noticias encontraras las noticias más destacadas, desde los próximos estrenos hasta los premios más importantes. Si eres un verdadero fanático del cine, nuestra sección de noticias es para ti. Aquí encontrarás todo lo que necesitas saber sobre tus películas y artistas favoritos, y mucho más. ¡Sigue leyendo para no perderte nada!
                            </p>
                            <a href="noticias.php" class="btn bg-primary text-white transUp">Mas informacion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="team section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center text-white pb-5">
                        <h2>Equipo <a class="navbar-brand"> <span class="text-primary ">CINE</span>-HUB</a>
                        </h2>
                    </div>
                </div>
            </div>b
            <div class="row">
                <?php
                include("administrador/config/bd.php");
                $sentenciaSQL = $conexion->prepare("SELECT * FROM contacto ORDER by id desc LIMIT 10;");
                $sentenciaSQL->execute();
                $listapublicaciones = $sentenciaSQL
                ?>
                <?php foreach ($listapublicaciones as $publicaciones) { ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card text-center bg-dark equipo">
                            <div class="card-body text-white">
                                <img class="img-fluid rounded-circle" src="./assets/<?php echo $publicaciones['imagen']; ?>" alt="">
                                <h3 class="card-title py-2"><?php echo $publicaciones['nombre']; ?>
                                    <p class="card-text">
                                        <br>
                                        <?php echo $publicaciones['descripcion']; ?>
                                    </p>
                                    <?php
                                    if (!empty($row["username"])) { ?>

                                        <p class="socials">
                                            <a href="<?php echo $publicaciones['facebook']; ?>" button type="submit" class="bi bi-facebook text-white mx-1 grow" target="_blank"></button></a>
                                            <a href="<?php echo $publicaciones['instagram']; ?>" button type="submit" class="bi bi-instagram text-white mx-1 grow" target="_blank"></button></a>
                                            <a href="<?php echo $publicaciones['github']; ?>" button type="submit" class="bi bi-github text-white mx-1 grow" target="_blank"></button></a>
                                        </p>
                                    <?php } else { ?>
                                        <p class="socials">
                                            <a button type="submit" class="miBoton bi bi-facebook text-white mx-1 grow" target="_blank"></button></a>
                                            <a button type="submit" class="miBoton bi bi-instagram text-white mx-1 grow" target="_blank"></button></a>
                                            <a button type="submit" class="miBoton bi bi-github text-white mx-1 grow" target="_blank"></button></a>
                                        </p>
                                    <?php } ?>
                            </div>
                        </div>
                        <br>
                    </div>
                <?php } ?>
            </div>
    </section>
    <section class="contact section-padding">
        <div class="container mt- 5 md-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center text-white pb-5">
                        <h2 id="email">Contacto</h2>
                        <p>Cuentános qué te ha parecido nuestra página, ¿Crees que necesita ciertas mejoras? ¡Ten confianza de contarnos lo que sea!</p>
                    </div>
                </div>
            </div>

            <?php
            if (!empty($row["username"])) { ?>
                <div class="row m-0">
                    <div class="col-md-12 p-0 pt-4 pb-4">
                        <form action="validar.php" method="post" class="bg-dark p-4 a-auto">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="" name="usuario" class="form-control" value="<?php echo $row["username"]; ?>" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" value="<?php echo $row["email"]; ?>" placeholder="" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" name="mensaje" placeholder="Mensaje:" rows="3" required></input>
                            </div>

                            <?php
                            $total_ratings = 0;
                            $rating_1 = 0;
                            $rating_2 = 0;
                            $rating_3 = 0;
                            $rating_4 = 0;
                            $rating_5 = 0;

                            $select_ratings = $conne->prepare("SELECT * FROM rate_blog");
                            $select_ratings->execute();
                            $total_reivews = $select_ratings->rowCount();

                            while ($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)) {
                                $total_ratings += $fetch_rating['rate'];
                                if ($fetch_rating['rate'] == 1) {
                                    $rating_1 += $fetch_rating['rate'];
                                }
                                if ($fetch_rating['rate'] == 2) {
                                    $rating_2 += $fetch_rating['rate'];
                                }
                                if ($fetch_rating['rate'] == 3) {
                                    $rating_3 += $fetch_rating['rate'];
                                }
                                if ($fetch_rating['rate'] == 4) {
                                    $rating_4 += $fetch_rating['rate'];
                                }
                                if ($fetch_rating['rate'] == 5) {
                                    $rating_5 += $fetch_rating['rate'];
                                }
                            }

                            if ($total_reivews != 0) {
                                $average = round($total_ratings / $total_reivews, 1);
                            } else {
                                $average = 0;
                            }
                            ?>

                            <?php if (!empty($row["username"])) { ?>
                                <div class="containerstar stars-index">
                                    <div class="rating rating-index">
                                        <input type="radio" value="5" name="rating_blog" style="--c:#FFFF00">
                                        <input type="radio" value="4" name="rating_blog" style="--c:#FFFF00">
                                        <input type="radio" value="3" name="rating_blog" style="--c:#FFFF00">
                                        <input type="radio" value="2" name="rating_blog" style="--c:#FFFF00">
                                        <input type="radio" value="1" name="rating_blog" style="--c:#FFFF00">
                                    </div>
                                </div>

                            <?php } ?>

                            <button type="submit" name="envioemail" class="btn btn-primary btn-lg btn-block mt-3">Enviar</button>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row m-0">
                    <div class="col-md-12 p-0 pt-4 pb-4">
                        <div class="bg-dark p-4 a-auto">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="" name="usuario" class="form-control" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="mb-3">
                                    <input type="text" class="miBoton form-control" placeholder="Mensaje:" rows="3"></input>
                                </div>

                            </div>

                            <div class="containerstar stars-index">
                                    <div class="rating rating-index">
                                        <input class="miBoton" type="radio" value="1" name="clr1" style="--c:#FFFF00">
                                        <input class="miBoton" type="radio" value="2" name="clr1" style="--c:#FFFF00">
                                        <input class="miBoton" type="radio" value="3" name="clr1" style="--c:#FFFF00">
                                        <input class="miBoton" type="radio" value="4" name="clr1" style="--c:#FFFF00">
                                        <input class="miBoton" type="radio" value="5" name="clr1" style="--c:#FFFF00">
                                    </div>
                            </div>

                            <button type="submit" id="nolog" class="miBoton btn btn-primary btn-lg btn-block mt-3 transRight">Enviar</button>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <?php include("template/pie.php") ?>
        <?php
        $sentenciaSQL = $conexion->prepare("SELECT * FROM inicio ORDER by id desc LIMIT 3;");
        $sentenciaSQL->execute();
        $listapublicaciones = $sentenciaSQL;
        ?>
        <script>
            <?php foreach ($listapublicaciones as $publicaciones) ?>
            const btnCerrarModal = document.querySelector("#cerrar");
            const modal = document.querySelector("#modal");
            const vid = document.querySelector(".vid");
            const clase = event.target.classList.contains('o')

            // Adjuntar evento de escucha al elemento padre (en este caso, el body)

            function vervideo() {
                document.addEventListener("click", function(event) {
                    if (clase) {
                        vid.setAttribute('src', '<?php echo $publicaciones["trailer"] ?>');
                        modal.showModal();
                    }
                });
                btnCerrarModal.addEventListener("click", () => {
                    vid.removeAttribute('src');
                    modal.closest("dialog").close();
                });

                modal.style.backgroundColor = "black";
                modal.style.maxWidth = "70ch";
            }
        </script>