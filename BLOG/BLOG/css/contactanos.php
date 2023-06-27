<?php include("./template/cabeza.php") ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles-contacto.css">
    <title>Document</title>
</head>
<body>
    <div class="contactanos">
        <h1 class="navbar-brand"> <span class="text-primary ">CONTA</span>CTANOS</h1>
        <p>¡Bienvenido a nuestra página de contacto de cine! Aquí encontrará todas las formas de ponerse en contacto con nosotros, desde nuestro correo electrónico hasta nuestro número de teléfono y dirección física. Si tiene alguna pregunta, comentario o sugerencia, no dude en ponerse en contacto con nuestro equipo. Estamos aquí para ayudarlo y brindarle la mejor experiencia de usuario posible. ¡Gracias por visitar nuestro blog de cine y esperamos poder escuchar de usted pronto!</p>
    </div>
    
    <section class="services section-padding"> <!--"section-padding": es una clase que se utiliza para aplicar un espaciado uniforme alrededor del contenido de una sección, con el fin de mejorar la legibilidad y la organización del contenido-->
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 correo">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body peli"> <!--  proporciona un relleno predeterminado de 1.25rem al contenido que contiene, lo que ayuda a crear una separación entre el contenido y el borde de la tarjeta-->
                            <i class="fa-solid fa-envelope fa-bounce"></i>
                            <h3 class="card-title">Correo</h3>
                            <p style="line-height:1.4;" class="lead">
                            ¿Tienes alguna pregunta o comentario que quieras compartir con nosotros? ¡Contáctanos! Estamos siempre disponibles para responder tus dudas y recibir tus comentarios. Puedes enviarnos un correo electrónico a [correo electrónico], o simplemente haz clic en el botón de abajo para escribirnos directamente. ¡Estamos ansiosos por saber de ti!
                            </p>
                            <br>
                            <a href="mailto:equipocinehub@gmail.com" class="btn bg-primary text-white">Contactanos</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 telefono">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="fa-brands fa-whatsapp fa-bounce"></i>
                            <h3 class="card-title">Telefono</h3>
                            <p class="lead">
                                ¿Necesitas ayuda o tienes alguna pregunta? ¡Contáctanos ahora a través de WhatsApp! Simplemente haz clic en el botón a continuación y serás dirigido a nuestro chat de WhatsApp para hablar con uno de nuestros representantes. ¡Estamos aquí para ayudarte en todo lo que necesites relacionado con el mundo del cine!
                                <br>
                                Contactanos al: +52 314 100 8320
                            </p>
                            <a href="https://wa.me/+523141008320" class="btn bg-primary text-white">Contactanos</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-10 ubicacion">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="fa-solid fa-map fa-bounce"></i>
                            <h3 class="card-title">Ubicacion</h3>
                            <p class="lead">
                                Nuestra oficina se encuentra ubicada en una zona céntrica y de fácil acceso, rodeada de lugares turísticos y culturales. Si necesitas visitarnos, puedes utilizar la siguiente dirección: [dirección completa]. Además, para facilitar tu llegada, hemos incluido un mapa de Google que te permitirá ubicarnos con mayor precisión. ¡Esperamos tu visita!
                            </p>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1332.7585637394047!2d-104.40089711855593!3d19.124737051170897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x84255a99f51cf4b5%3A0x71073f9935f08f0a!2sFacultad%20de%20Ingenier%C3%ADa%20Electromec%C3%A1nica%20(FIE)!5e0!3m2!1ses-419!2smx!4v1683492493863!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <?php include("template/pie.php") ?>
</body>
</html>