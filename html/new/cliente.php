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
    $dni_cliente = $_POST['dni'];
    $nombre_apellidos_cliente = $_POST['nombre_apellidos'];
    $email_cliente = $_POST['email_cliente'];

    $datos_crear = array($dni_cliente, $nombre_apellidos_cliente, $email_cliente);

    if ($dni_cliente != '' && $nombre_apellidos_cliente != '' && $email_cliente != '') {
        $guardar = new \functionsUsers\Admin();
        $guardar->create_cliente($datos_crear);


        $correo = new \correo\Correo();
        $asunto = 'Bienvenido a Informática Pepe';
        $correo->enviar_correos_account($email_cliente, $asunto);

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
                    <p>Nuevo Cliente</p>
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
                        <div class="form-group col">
                            <div class="col-4 offset-4 mb-3">
                                <label for="dni"><span><img src="../../images/icons/info-circle.svg" alt="icono dni"></span> DNI:</label>
                                <input type="text" class="form-control" id="dni" name="dni"
                                       placeholder="DNI nuevo cliente" >
                            </div>
                            <div class="col-4 offset-4 mb-3">
                                <label for="nombre_apellidos"><span><img src="../../images/icons/pen-fill.svg" alt="icono nombre y apellidos"></span> Nombre y Apellidos:</label>
                                <input type="text" class="form-control" id="nombre_apellidos" name="nombre_apellidos"
                                       placeholder="Nombre y apellidos nuevo cliente" >
                            </div>
                            <div class="col-4 offset-4">
                                <label for="email_cliente"><span><img src="../../images/icons/envelope-fill.svg" alt="icono email"></span> E-mail:</label>
                                <input type="email" class="form-control" id="email_cliente" name="email_cliente"
                                       placeholder="E-mail nuevo cliente" >
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row justify-content-center">
                            <button type="submit" name="Crear" class="btn login_btn"><span><img src="../../images/icons/plus-circle-fill.svg" alt="icono nuevo artículo"></span> Crear nuevo cliente</button>

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
