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
                    <p>Búsqueda por DNI</p>
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
                                <label for="dni"><span><img src="../../images/icons/credit-card-2-front-fill.svg" alt="icono dni"></span> DNI:</label>
                                <input type="text" class="form-control" id="dni" name="dni"
                                       placeholder="Introduce el DNI del cliente" >
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row justify-content-center">
                            <button type="submit" name="Buscar" class="btn login_btn"><span><img src="../../images/icons/search.svg" alt="icono nuevo artículo"></span> Buscar DNI</button>

                        </div>
                    </form>
                    <?php
                    if (isset($_POST['Buscar'])) {
                        $dni_cliente = $_POST['dni'];

                        if ($dni_cliente != '') {
                            $buscar = new \functionsUsers\Conexion();
                            $articulos=  $buscar->mostrar_articulos_dni($dni_cliente);
                            echo "<h3 style='text-align: center;'>Lista artículos del cliente con DNI: $dni_cliente</h3><ul class='lista_articulos_find'>";
                            if($articulos!=''){
                                echo $articulos;
                            }else{
                                echo "<li style='color: red;'> No existen artículos para el DNI: $dni_cliente</li>";
                            }
                            echo "</ul>";
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
