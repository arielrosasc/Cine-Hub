<?php include("template/cabecera.php") ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Open Sans';
    }

    .jumbotron {
        position: relative;
        top: -23px;
    }


    .menu-horizontal {
        font-size: 18px;
        position: relative;
        top: -80px;
        list-style: none;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .menu-horizontal>li>a {
        display: block;
        padding: 15px 30px;
        color: white;
        text-decoration: none;
    }

    .menu-horizontal>li:hover {
        background-color: #106cfc;
        border-radius: 10px;
    }

    .menu-vertical {
        position: absolute;
        display: none;
        list-style: none;
        width: 125px;
        background-color: #18171c;
    }

    .menu-horizontal li:hover .menu-vertical {
        display: block;
    }

    .menu-vertical li:hover {
        background-color: #106cfc;
        border-radius: 10px;
    }

    .menu-vertical li a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 15px 15px 15px 20px;
    }
</style>

<div class="col-md-12">
    <div class="jumbotron">

        <?php if ($row["rol_id"] == 1) { ?>
            <h1 class="display-3">Bienvenid@ Dueño@ <?php echo $row["username"]; ?> </h1>
        <?php } ?>

        <?php if ($row["rol_id"] == 2) { ?>
            <h1 class="display-3">Bienvenid@ <?php echo $row["username"]; ?> </h1>
        <?php } ?>

        <p class="lead">Administra <a class="navbar-brand"> <span class="text-primary ">CINE</span>-HUB</a> </p>
    </div>
</div>
<nav>
    <ul class="menu-horizontal">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <li>
            <a href="">Peliculas</a>
            <ul class="menu-vertical">
                <li><a href="peliculas_recientes.php">Recientes</a></li>
                <li><a href="peliculas_clasicas.php">Clasicas</a></li>
                <li><a href="peliculas_proximas.php">Proximas</a></li>
            </ul>
        </li>
        <li>
            <a href="">Series</a>
            <ul class="menu-vertical">
                <li><a href="series_recientes.php">Recientes</a></li>
                <li><a href="series_clasicas.php">Clasicas</a></li>
                <li><a href="series_proximas.php">Proximas</a></li>
            </ul>
        </li>
        <li>
            <a href="">Reseñas</a>
            <ul class="menu-vertical">
                <li><a href="reseñas_peliculas.php">Peliculas</a></li>
                <li><a href="reseñas_series.php">Series</a></li>
            </ul>
        </li>
        <li><a href="noticia.php">Noticias</a></li>

        <li><a href="galardonadas.php">Galardonadas</a></li>


    </ul>
</nav>


<?php include("template/pie.php") ?>