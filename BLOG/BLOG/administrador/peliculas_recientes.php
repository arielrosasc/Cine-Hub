<?php include("template/cabecera.php") ?>
<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtTitulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
$txtComentario = (isset($_POST['txtComentario'])) ? $_POST['txtComentario'] : "";
$netflix = (isset($_POST['netflix'])) ? $_POST['netflix'] : "";
$hbomax = (isset($_POST['hbomax'])) ? $_POST['hbomax'] : "";
$primevideo = (isset($_POST['primevideo'])) ? $_POST['primevideo'] : "";
$disney = (isset($_POST['disney'])) ? $_POST['disney'] : "";
$star = (isset($_POST['star'])) ? $_POST['star'] : "";
$trailer = (isset($_POST['trailer'])) ? $_POST['trailer'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("config/bd.php");

switch ($accion) {

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO peliculas_recientes (titulo, comentario, imagen, netflix, hbomax, primevideo, disney, star, trailer) VALUES (:titulo, :comentario, :imagen, :netflix, :hbomax, :primevideo, :disney, :star, :trailer);");
        $sentenciaSQL->bindParam(':titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':comentario', $txtComentario);
        $sentenciaSQL->bindParam(':netflix', $netflix);
        $sentenciaSQL->bindParam(':hbomax', $hbomax);
        $sentenciaSQL->bindParam(':primevideo', $primevideo);
        $sentenciaSQL->bindParam(':disney', $disney);
        $sentenciaSQL->bindParam(':star', $star);
        $sentenciaSQL->bindParam(':trailer', $trailer);

        $nombreArchivo = ($txtImagen != "") ? "copia_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../assets/" . $nombreArchivo);
        }
        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location: peliculas_recientes.php");
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE peliculas_recientes SET titulo=:titulo, comentario=:comentario, netflix=:netflix, hbomax=:hbomax, primevideo=:primevideo, disney=:disney, star=:star, trailer=:trailer WHERE id=:id");
        $sentenciaSQL->bindParam(':titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':comentario', $txtComentario);
        $sentenciaSQL->bindParam(':netflix', $netflix);
        $sentenciaSQL->bindParam(':hbomax', $hbomax);
        $sentenciaSQL->bindParam(':primevideo', $primevideo);
        $sentenciaSQL->bindParam(':disney', $disney);
        $sentenciaSQL->bindParam(':star', $star);
        $sentenciaSQL->bindParam(':trailer', $trailer);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {
            $nombreArchivo = ($txtImagen != "") ? $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../assets/" . $nombreArchivo);
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM peliculas_recientes WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $publicaciones = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $sentenciaSQL = $conexion->prepare("UPDATE peliculas_recientes SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        header("Location: peliculas_recientes.php");
        break;

    case "Cancelar":
        header("Location: peliculas_recientes.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM peliculas_recientes WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $publicaciones = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtImagen = $publicaciones['imagen'];
        $txtTitulo = $publicaciones['titulo'];
        $txtComentario = $publicaciones['comentario'];
        $netflix = $publicaciones['netflix'];
        $hbomax = $publicaciones['hbomax'];
        $primevideo = $publicaciones['primevideo'];
        $disney = $publicaciones['disney'];
        $star = $publicaciones['star'];
        $trailer = $publicaciones['trailer'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM peliculas_recientes WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location: peliculas_recientes.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM peliculas_recientes ORDER by id desc");
$sentenciaSQL->execute();
$listapublicaciones = $sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Datos de la publicacion
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="">Imagen:</label>
                    <br />
                    <?php if ($txtImagen != "") { ?>
                        <img class="img-thumbnail rounded" src="../assets/<?php echo $txtImagen; ?>" width="80" alt="" srcset="">
                        </br></br>
                        <input type="text" value="<?php echo $txtImagen; ?>" required readonly style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" placeholder="Nombre imagen">
                        </br>

                    <?php   }   ?>

                    <label for="">Seleccione una imagen:</label>
                    <input type="file" for="txtImagen" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                </div>

                <div class="form-group">
                    <label for="txtTitulo">Título:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $txtTitulo; ?>" name="txtTitulo" id="txtTitulo" placeholder="Ingrese el título">
                </div>

                <div class="form-group">
                    <label for="txtComentario">Comentario:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $txtComentario; ?>" name="txtComentario" id="txtComentario" placeholder="Ingrese un comentario">
                </div>

                <div class="form-group">
                    <label for="netflix">NETFLIX URL:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $netflix; ?>" name="netflix" id="netflix" placeholder="URL de NETFLIX: ">
                </div>

                <div class="form-group">
                    <label for="hbomax">HBO MAX URL:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $hbomax; ?>" name="hbomax" id="hbomax" placeholder="URL de HBO MAX: ">
                </div>
                <div class="form-group">
                    <label for="primevideo">PRIME VIDEO URL:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $primevideo; ?>" name="primevideo" id="primevideo" placeholder="URL de PRIME VIDEO: ">
                </div>

                <div class="form-group">
                    <label for="disney">DISNEY+ URL:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $disney; ?>" name="disney" id="disney" placeholder="URL de DISNEY+: ">
                </div>

                <div class="form-group">
                    <label for="star">STAR+ URL:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $star; ?>" name="star" id="star" placeholder="URL de STAR+: ">
                </div>

                <div class="form-group">
                    <label for="trailer">Trailer URL:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $trailer; ?>" name="trailer" id="trailer" placeholder="URL del Trailer: ">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listapublicaciones as $publicaciones) { ?>
                </tr>
                <td><?php echo $publicaciones['id']; ?></td>
                <td><?php echo $publicaciones['titulo']; ?></td>
                <td>
                    <img class="img-thumbnail rounded" src="../assets/<?php echo $publicaciones['imagen']; ?>" width="80" alt="" srcset="">
                </td>
                <td>
                    <form method="post">

                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $publicaciones['id']; ?>" />

                        <input type="submit" name="accion" value="Seleccionar" style="margin:6px;" class="btn btn-primary" />

                        <input type="submit" name="accion" value="Borrar" style="margin:6px;" class="btn btn-danger" />
                    </form>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("template/pie.php") ?>