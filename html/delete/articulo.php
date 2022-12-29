<?php
session_start();
include '../../autoload.php';

if (isset($_SESSION['rol'])) {
    $rol = new \functionsUsers\Conexion();
    $nombre_rol = $rol->get_name_rol($_SESSION['rol']);
    if ($nombre_rol != 'Tenda') {
        header("Location: ../../html/registrologin/login.php");
    }
} else {
    header("Location: ../../html/registrologin/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!--icono da páxina-->
        <link rel="icon" type="image/png" href="../../images/icon.ico">
        <!--arquivos css-->
        <link rel="stylesheet" href="../../css/index.css">
        <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
        <!--título da páxina-->
        <title>SAT Panel</title>
    </head>
    <!--body-->

    <body>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-2">
                    <a href="../../index.php"><p class="satpanel">SAT Panel</p></a>
                </div>
                <div class="col-6 id_title">
                    <p>Borrar artículo</p>
                </div>

                <div class="col-2 logout">
                    <a href="../../index.php"><span><img src="../../images/icons/arrow-left.svg" alt="icono volver atrás"></span> Volver atrás</a>
                </div>
                <div class="col-2 logout">
                    <a href="../registrologin/logout.php"><span><img src="../../images/icons/power.svg" alt="icono cerrar sesión"></span> Cerrar Sesión</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                        <div class="form-group row justify-content-center">
                            <div class="col-4">
                                <label for="articulo"><span><img src="../../images/icons/person-fill.svg" alt="icono cliente"></span> Artículo a borrar:</label>
                                <br>
                                <select name="articulo" id="articulo">
                                    <option value="">Selecciona un artículo</option>
                                    <?php
                                    $articulos = new \functionsUsers\Conexion();
                                    echo $articulos->mostrar_articulos();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row justify-content-center">
                            <button type="submit" name="Eliminar" class="btn login_btn"><span><img src="../../images/icons/x-circle-fill.svg" alt="icono eliminar artículo"></span> Eliminar artículo</button>

                        </div>
                    </form>
                    <?php
                    if (isset($_POST['Eliminar'])) {
                        $articulo = $_POST['articulo'];
                        if ($articulo != '') {
                                $admin = new \functionsUsers\Admin();
                                $delete_articulo = $admin->delete_articulo($articulo);
                                if ($delete_articulo) {
                                    ?>
                                    <p style='text-align: center; color:red;'>Artículo eliminado.</p>
                                    <p style='text-align: center; font-weight: bold;'>La página se actualizará...</p><?php
                                    header("Refresh:2");
                                }
                            
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--arquivos js-->
        <script src="../../js/jquery.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <!--script para función popover-->
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        </script>
        <!--script para función tooltip-->
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </body>

</html>
