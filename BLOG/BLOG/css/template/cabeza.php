<?php
header("Cache-Control: no-cache, must-revalidate");
session_cache_limiter('nocache');
require 'config.php';
if (!empty($_SESSION["id"])) {
    $user_id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='$user_id'");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location:");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdeliver.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="shortcut icon" href="assets/logo2.webP">

    <title> Cine-Hub </title>

</head>

<body id="top">  
        <a class="top-btn" href="#top">
            <i class="fa-duotone fa-circle-arrow-up fa-bounce" style="--fa-primary-color: #ffffff; --fa-secondary-color: #106cfc; --fa-secondary-opacity: 1;"></i>
        <!--------ALERTAS---------->
    <!-- navbar-expand-lg: para que se expanda la barra de navegacion desde el tamaño de la pantalla
         navbar-dark: establece el fondo de la barra de navegación en un tono oscuro y el color del texto en un tono más claro para mejorar la legibilidad
         bg-dark: bg(background) se usa para pintar el fondo de un color
         fixed-top: fija un elemento a la parte  superior de la pantalla -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

        <div class="container d-flex justify-content-between">

            <!-- navbar-brand: se utiliza para agregar un logotipo o nombre de marca a la barra de navegación de una página web
                 text-primary: -->
            <div class="texto-cine-cabecera">
                <a class=" navbar-brand letra-c fa-solid fa-c fa-flip"  href="index.php" style="color: #106cfc;"></a>
                <a name="cinehub" href="index.php"class="navbar-brand grow2"> <span class="text-primary cine">Cine</span>-Hub</a>
            </div>
            <!--
                toggler: es un botón o un elemento que se utiliza para alternar el estado de otro elemento, como un menú de navegación o un panel, entre visible e invisible.  
                navbar-toggler: crea un boton que permite a los usuarios abrir y cerrar la barra de navegación en pantallas mas pequeñas (usar boton como se ve abajo)
                -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarS" aria-controls="navbarS" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> <!-- Dibuja el icono con 3 rayitas-->
            </button>

            <div class="collapse navbar-collapse" id="navbarS"> <!-- se utiliza para crear un elemento de menú de navegación que se puede colapsar y ocultar en pantallas más pequeñas, y se identifica de forma única en el documento HTML mediante el atributo "id"-->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> <!--
                navbar-nav: indica que este elemento es una lista de elementos de menú de navegación que se mostrarán en la barra de navegación. 
                ms-auto: se utiliza para alinear los elementos del menú de navegación a la derecha de la barra de navegación 
                mb-2 mb-lg-0: se utiliza para establecer un margen inferior en dispositivos más grandes.-->
                    <li class="nav-item grow2">
                        <a href="index.php" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item grow2">
                        <a href="peliculas.php" class="nav-link">Peliculas</a>
                    </li>
                    <li class="nav-item grow2">
                        <a href="series.php" class="nav-link">Series</a>
                    </li>
                    <li class="nav-item grow2">
                        <a href="reseñas.php" class="nav-link">Reseñas</a>
                    </li>
                    <li class="nav-item grow2">
                        <a href="noticias.php" class="nav-link">Noticias</a>
                    </li>
                    <li class="nav-item grow2">
                        <a href="galardonadas.php" class="nav-link">Galardonadas</a>
                    </li>

                    <?php
                    if (!empty($row["username"])) { ?>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link grow2">Cerrar sesión</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link grow2">Regresar</a>
                        </li>
                    <?php
                    } ?>

                    <?php
                    if (!empty($_SESSION["id"])) {
                        $id = $_SESSION["id"];
                        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id=$id");
                        $row = mysqli_fetch_assoc($result);
                        if ($row["rol_id"] == 1 or $row["rol_id"] == 2) { ?>
                            <li class="nav-item">
                                <a href="/BLOG/administrador/inicio.php" class="nav-link grow2">Admin</a>
                            </li>
                    <?php }
                    } ?>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel: Muestra una serie de imágenes o contenido en una presentación de diapositivas
         Carousel slide:se utiliza para inicializar el carrusel y controlar su comportamiento
         data-bs-ride="carousel": inicia automáticamente el carrusel de imágenes en el momento en que se carga la página web. 
        -->
    <div id="carouselE" class="carousel slide" data-bs-ride="carousel">
        <script>
            // Adjuntar evento de escucha al elemento padre (en este caso, el body)
            document.body.addEventListener("click", function(event) {
                if (event.target.classList.contains("miBoton")) {
                    event.preventDefault(); // Evita que el botón funcione su comportamiento por defecto
                    Swal.fire({
                        icon: 'error',
                        title: 'Inicia sesion / Registrarse',
                        text: 'Inicia sesion o regístrate para seguir viendo la pagina sin interrupciones',
                        confirmButtonColor: '#28a745',
                        confirmButtonText: '<a class="botoniniciar text-light text-decoration-none" href="login.php">Iniciar sesion / Registrarse</a>',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        backdrop: 'true',
                    });
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- <script src="js/alerta.js"></script> -->