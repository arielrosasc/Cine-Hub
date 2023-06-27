<?php include("template/cabecera.php") ?>
<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtName = (isset($_POST['txtName'])) ? $_POST['txtName'] : "";
$txtEmail = (isset($_POST['txtEmail'])) ? $_POST['txtEmail'] : "";
$txtRol = (isset($_POST['txtRol'])) ? $_POST['txtRol'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("config/bd.php");

switch ($accion) {

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET rol_id=:rol_id WHERE id=:id");
        $sentenciaSQL->bindParam(':rol_id', $txtRol);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location: owner.php");
        break;

    case "Cancelar":
        header("Location: owner.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $publicaciones = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtName = $publicaciones['username'];
        $txtEmail = $publicaciones['email'];
        $rol_id = $publicaciones['rol_id'];
        $SQL = $conexion->prepare("SELECT * FROM roles WHERE id=:id");
        $SQL->bindParam(':id', $rol_id);
        $SQL->execute();
        $publi = $SQL->fetch(PDO::FETCH_LAZY);
        $txtRol = $publi['roles'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location: owner.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE rol_id!=1 ORDER by rol_id asc");
$sentenciaSQL->execute();
$lista_usuarios = $sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Datos de los usuarios
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID del usuario">
                </div>

                <div class="form-group">
                    <label for="txtName">Nombre:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" required readonly class="form-control" value="<?php echo $txtName; ?>" name="txtName" id="txtName" placeholder="Nombre del usuario">
                </div>

                <div class="form-group">
                    <label for="txtEmail">Email:</label>
                    <input type="text" style="background-color: #18171c; border: 1px solid #044c9c;" required readonly class="form-control" value="<?php echo $txtEmail; ?>" name="txtEmail" id="txtEmail" placeholder="Email del usuario">
                </div>

                <div class="form-group">
                    <label for="txtRol">Rol:</label>
                    <select class="text-secondary" class="box" style="background-color: #18171c; border: 1px solid #044c9c;" name="txtRol" id="txtRol">
                        <?php if (empty($txtRol)) { ?>
                            <option value="">Sin rol</option>
                        <?php } else if($txtRol == 'Usuario') { ?>
                            <option value="3"><?php echo $txtRol; ?></option>
                            <option value="2">Administrador</option>
                            <option value="1">Dueño</option>

                        <?php } else if($txtRol == 'Administrador') { ?>
                            <option value="2"><?php echo $txtRol; ?></option>
                            <option value="3">Usuario</option>
                            <option value="1">Dueño</option>
                        <?php } ?>
                      
                    </select>
                </div>


                <div class="btn-group" role="group" aria-label="">
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
                <th>Rol</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_usuarios as $usuarios) { ?>
                </tr>

                <td><?php echo $usuarios['rol_id']; ?></td>
                <td><?php echo $usuarios['username']; ?></td>
                <td><?php echo $usuarios['email']; ?></td>

                
                <?php 
                // Si se quisiera agarrar a los dueños tambien sin seleccionar el dueño actual
                // if ($user_id == $user_id) { 
                //     $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE id!='$user_id'");
                //     $sentenciaSQL->execute();
                //     $lista_usuarios = $sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
                //     foreach ($lista_usuarios as $usuarios){
                    ?>
<!--                     
                    <td><?php echo $usuarios['rol_id']; ?></td>
                    <td><?php echo $usuarios['username']; ?></td>
                    <td><?php echo $usuarios['email']; ?></td> -->

                <td>
                    <form method="post">

                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $usuarios['id']; ?>" />

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