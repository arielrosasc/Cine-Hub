<?php include("template/cabecera.php") ?>
<?php

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : "";
$instagram = (isset($_POST['instagram'])) ? $_POST['instagram'] : "";
$github = (isset($_POST['github'])) ? $_POST['github'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
include("config/bd.php");

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO contacto (nombre, descripcion, imagen, facebook, instagram, github) VALUES (:nombre, :descripcion, :imagen, :facebook, :instagram, :github);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':facebook', $facebook);
        $sentenciaSQL->bindParam(':instagram', $instagram);
        $sentenciaSQL->bindParam(':github', $github);

        $nombreArchivo = ($txtImagen != "") ? $_FILES["txtImagen"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../assets/" . $nombreArchivo);
        }
        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();

        header("Location: contacto.php");
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE contacto SET nombre=:nombre, descripcion=:descripcion, facebook=:facebook, instagram=:instagram, github=:github WHERE id=:id ");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':facebook', $facebook);
        $sentenciaSQL->bindParam(':instagram', $instagram);
        $sentenciaSQL->bindParam(':github', $github);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        if ($txtImagen != "") {
            $nombreArchivo = ($txtImagen != "") ? $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../assets/" . $nombreArchivo);
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM contacto WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $publicaciones = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $sentenciaSQL = $conexion->prepare("UPDATE contacto SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }
        
        header("Location: contacto.php");
        break;

    case "Cancelar":
        header("Location: contacto.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM contacto WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $publicaciones = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtImagen = $publicaciones['imagen'];
        $txtNombre = $publicaciones['nombre'];
        $txtDescripcion = $publicaciones['descripcion'];
        $facebook = $publicaciones['facebook'];
        $instagram = $publicaciones['instagram'];
        $github = $publicaciones['github'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM contacto WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location: contacto.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM contacto ORDER by id desc");
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
                    <label for="txtTitulo">Nombre:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Ingrese su nombre: ">
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
                    <label for="txtDescripcion">Descripcion:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Ingrese una descripcion propia: ">
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $facebook; ?>" name="facebook" id="facebook" placeholder="Ingrese su Facebook:">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $instagram; ?>" name="instagram" id="instagram" placeholder="Ingrese su Instagram:">
                </div>
                <div class="form-group">
                    <label for="github">GitHub:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" class="form-control" value="<?php echo $github; ?>" name="github" id="github" placeholder="Ingrese su GitHub:">
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
                <th>Nombre</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($listapublicaciones as $publicaciones) { ?>
                </tr>
                <td><?php echo $publicaciones['id']; ?></td>
                <td><?php echo $publicaciones['nombre']; ?></td>


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