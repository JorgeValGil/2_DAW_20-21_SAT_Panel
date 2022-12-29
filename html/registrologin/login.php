<?php

namespace registrologin;

session_start();

include '../../autoload.php';

class login {

    private $blank;
    private $err;

    public function __construct() {
        
    }

    public function __get($value) {
        return $this->$value;
    }

    function login() {

        if ($_POST['username'] == '' || $_POST['password'] == '') {
            $this->blank = true;
        } else {
            $conexion = new \functionsUsers\Conexion;
            $usu = $conexion->comprobar_usuario($_POST['username'], $_POST['password']);
            if ($usu === false) {
                $this->err = true;
            } else {
                $_SESSION['id_user'] = $usu[0];
                $_SESSION['usuario'] = $usu[1];
                $_SESSION['rol'] = $usu[2];

                header("Location: ../../index.php");
            }
        }
    }

}

if (isset($_POST['Login'])) {
    $login = new \registrologin\login();
    $login->login();
    $blank = $login->blank;
    $err = $login->err;
}
if (isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!--icono da páxina-->
        <link rel="icon" type="image/png" href="../../images/icon.ico">
        <!--arquivos css-->
        <link rel="stylesheet" href="../../css/login.css">
        <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
        <!--título da páxina-->
        <title>SAT Panel</title>
    </head>
    <!--body-->

    <body>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <a href="../../index.php"><img src="../../images/logo_1920x1080.png" class="brand_logo" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center form_container">
                        <div>
                            <p class="title">Iniciar Sesión</p>
                        </div>
                        <?php
                        if (isset($blank) and $blank == true) {
                            echo "<p style='color: red; font-weight: bold'> Rellena ambos campos</p>";
                        }
                        if (isset($err) and $err == true) {
                            echo "<p style='color: red; font-weight: bold'> Revise usuario y contraseña</p>";
                        }
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img class="icon_navbar" src="../../images/icons/person.svg"
                                                                        alt="icono user"></span>
                                </div>
                                <input type="text" name="username" class="form-control input_user" value=""
                                       placeholder="Usuario">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img class="icon_navbar" src="../../images/icons/key.svg"
                                                                        alt="icono chave"></span>
                                </div>
                                <input type="password" name="password" class="form-control input_pass" value=""
                                       placeholder="Contraseña">
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="Login" class="btn login_btn">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            ¿No tienes cuenta? <a href="signup.php" class="ml-2">Crear Cuenta</a>
                        </div>
                    </div>
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