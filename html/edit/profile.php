<?php

namespace edit;

session_start();
include '../../autoload.php';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

class profile {

    private $blank_password;
    private $modify_password;
    private $password_fail;
    private $equal_password;

    public function __construct() {
        
    }

    public function __get($value) {
        return $this->$value;
    }

    function changePassword() {
        if ($_POST['pass'] == '' || $_POST['new_pass'] == '' || $_POST['new_pass1'] == '') {
            $this->blank_password = true;
        } else {
            $nombre = $_SESSION['usuario'];
            $conexion = new \functionsUsers\Conexion();
            $actual_password = $conexion->getPassword($nombre);

            if ($actual_password) {
                $password_verify = password_verify($_POST['pass'], $actual_password);

                if ($password_verify) {
                    $validar = new \validarRegistro\RegistrarValidar();
                    $new_pass = $validar->compare_password($_POST['new_pass'], $_POST['new_pass1']);
                    if ($new_pass == false) {
                        $this->equal_password = $new_pass;
                    } else {
                        $admin = new \functionsUsers\Admin();
                        $userdata = array($new_pass, $nombre);
                        $this->modify_password = $admin->updatepassword($userdata);
                        
                        $email_user = $conexion->get_email_user($nombre);
                        $asunto = 'Cambio de Contraseña';
                        $correo = new \correo\Correo();
                        $correo->enviar_correo_contrasena($email_user, $asunto);
                    }
                } else {
                    $this->password_fail = true;
                }
            }
        }
    }

}

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../html/registrologin/login.php");
}
if (isset($_POST['Cambiar'])) {
    $password = new \edit\profile();
    $password->changePassword();



    $blank_password = $password->blank_password;
    $modify_password = $password->modify_password;
    $password_fail = $password->password_fail;
    $equal_password = $password->equal_password;
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
                    <p><?php
                        echo $_SESSION['usuario'];
                        ?> </p>
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
                            <div class="col-8 offset-2 mb-3">
                                <label for="pass"><span><img src="../../images/icons/key.svg" alt="icono llave"></span> Contraseña Actual:</label>
                                <input type="password" class="form-control" id="pass" name="pass"
                                       placeholder="Contraseña actual" >
                            </div>
                            <div class="col-8 offset-2 mb-3">
                                <label for="new_pass"><span><img src="../../images/icons/key-fill.svg" alt="icono llave"></span> Nueva Contraseña:</label>
                                <input type="password" class="form-control" id="new_pass" name="new_pass"
                                       placeholder="Nueva contraseña" >
                            </div>
                            <div class="col-8 offset-2">
                                <label for="new_pass1"><span><img src="../../images/icons/key-fill.svg" alt="icono llave"></span> Confirmación Nueva Contraseña:</label>
                                <input type="password" class="form-control" id="new_pass1" name="new_pass1"
                                       placeholder="Nueva contraseña" >
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row justify-content-center">
                            <button type="submit" name="Cambiar" class="btn login_btn"><span><img src="../../images/icons/check-circle.svg" alt="icono cambio de contraseña"></span> Cambiar Contraseña</button>

                        </div>
                    </form>
                    <?php
                    if (isset($blank_password) and $blank_password == true) {
                        echo "<p style='color: red; font-weight: bold; text-align: center;'> Rellena todos los campos.</p>";
                    }
                    if (isset($password_fail) and $password_fail == true) {
                        echo "<p style='color: red; font-weight: bold; text-align: center;'> Introduce la contraseña actual correctamente.</p>";
                    }
                    if (isset($equal_password) and $equal_password == false) {
                        echo "<p style='color: red; font-weight: bold; text-align: center;'> Las contraseñas nuevas deben coincidir.</p>";
                    }
                    if (isset($modify_password) and $modify_password == true) {
                        echo "<p style='color: blue; font-weight: bold; text-align: center;'> Contraseña modificada correctamente.</p>";
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
