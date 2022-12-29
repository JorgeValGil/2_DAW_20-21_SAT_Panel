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

if (isset($_POST['Crear'])) {
    $titulo_crear = $_POST['titulo'];
    $descripcion_crear = $_POST['descripcion'];
    $precio_crear = $_POST['precio'];
    $comentario_crear = $_POST['selector_cliente'];
    $tipo_crear = $_POST['tipo_articulo'];

    $datos_crear = array($titulo_crear, $descripcion_crear, $precio_crear, $comentario_crear, $tipo_crear);

    if ($titulo_crear != '' && $descripcion_crear != '' && $precio_crear != '') {
        $guardar = new \functionsUsers\Admin();
        $guardar->create_articulo($datos_crear);

        header("Location: ../../index.php");
    }
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
                    <p>Nuevo artículo</p>
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
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="titulo"><span><img src="../../images/icons/fonts.svg" alt="icono titulo"></span> Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       placeholder="Título del artículo" >
                            </div>
                            <div class="col-6">
                                <label for="descripcion"><span><img src="../../images/icons/info.svg" alt="icono descripcion"></span> Descripción: </label>
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del artículo"></textarea>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-6">

                                <label for="precio"><span><img src="../../images/icons/server.svg" alt="icono precio"></span> Precio: </label><br>
                                <input type="number" id="precio" name="precio" min="0" step="0.01" value="0.00"><span>€</span>

                            </div>
                            <div class="col-6">

                                <label for="tipo_articulo"><span><img src="../../images/icons/tags-fill.svg" alt="icono tipo"></span> Tipo: </label><br>
                                <select class="form-control" id="tipo_articulo" name="tipo_articulo">
                                    <?php
                                    $clientes = new \functionsUsers\Conexion();
                                    echo $clientes->mostrar_tipos_articulo();
                                    ?>
                                </select>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="selector_cliente"><span><img src="../../images/icons/person-fill.svg" alt="icono user"></span> Cliente:</label>
                                <select class="form-control" id="selector_cliente" name="selector_cliente">
                                    <?php
                                    $clientes = new \functionsUsers\Conexion();
                                    echo $clientes->mostrar_clientes();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row justify-content-center">
                            <button type="submit" name="Crear" class="btn login_btn"><span><img src="../../images/icons/plus-circle-fill.svg" alt="icono nuevo artículo"></span> Crear nuevo artículo</button>

                        </div>
                    </form>
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
