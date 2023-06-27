<?php include("template/cabecera.php") ?>
<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtTitulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
$txtComentario = (isset($_POST['txtComentario'])) ? $_POST['txtComentario'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("config/bd.php");
switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO reseñas_peliculas (titulo, comentario, imagen) VALUES (:titulo, :comentario, :imagen);");
        $sentenciaSQL->bindParam(':titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':comentario', $txtComentario);
        $nombreArchivo = ($txtImagen != "") ? "copia_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../assets/" . $nombreArchivo);
        }
        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location: reseñas_peliculas.php");
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE reseñas_peliculas SET titulo=:titulo WHERE id=:id");
        $sentenciaSQL->bindParam(':titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $sentenciaSQL = $conexion->prepare("UPDATE reseñas_peliculas SET comentario=:comentario WHERE id=:id");
        $sentenciaSQL->bindParam(':comentario', $txtComentario);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {
            $nombreArchivo = ($txtImagen != "") ? $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../assets/" . $nombreArchivo);
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM reseñas_peliculas WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $publicaciones = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $sentenciaSQL = $conexion->prepare("UPDATE reseñas_peliculas SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        header("Location:reseñas_peliculas.php");
        break;

    case "Cancelar":
        header("Location: reseñas_peliculas.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM reseñas_peliculas WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $publicaciones = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtImagen = $publicaciones['imagen'];
        $txtTitulo = $publicaciones['titulo'];
        $txtComentario = $publicaciones['comentario'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM reseñas_peliculas WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location: reseñas_peliculas.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM reseñas_peliculas ORDER by id desc");
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
                    <label for="txtTitulo">Título:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $txtTitulo; ?>" name="txtTitulo" id="txtTitulo" placeholder="Ingrese el título">
                </div>

                <div class="form-group">
                    <label for="">Imagen:</label>
                    <br />
                    <?php if ($txtImagen != "") { ?>
                        <img class="img-thumbnail rounded" src="../assets/<?php echo $txtImagen; ?>" width="80" alt="" srcset="">
                        <br /><br />
                        <input type="text" value="<?php echo $txtImagen; ?>" required readonly style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" placeholder="Nombre imagen">
                    <?php   }   ?>
                    <br />

                    <label for="">Seleccione una imagen:</label>
                    <input type="file" for="txtImagen" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                </div>
                <div class="form-group">
                    <label for="txtComentario">Comentario:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $txtComentario; ?>" name="txtComentario" id="txtComentario" placeholder="Ingrese un comentario">
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

                        <input type="submit" name="accion" value="Borrar" style="margin:4px;" class="btn btn-danger" />
                    </form>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



<?php include("template/pie.php") ?>