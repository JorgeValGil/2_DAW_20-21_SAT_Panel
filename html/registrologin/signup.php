<?php

namespace registrologin;

session_start();

include '../../autoload.php';

class signup {

    private $newaccountblank;
    private $email_error;
    private $email_format;
    private $password_error;
    private $department_error;

    public function __construct() {
        
    }

    public function __get($value) {
        return $this->$value;
    }

    function create() {
        if ($_POST['username'] == '' || $_POST['email'] == '' || $_POST['password'] == '' || $_POST['password1'] == '' || $_POST['department'] == '') {
            $this->newaccountblank = true;
        } else {
            // Objeto de la clase Conexion para llamar a sus funciones
            $objetoConexion = new \functionsUsers\Conexion();
            $email = $objetoConexion->comprobar_email(array($_POST['email']));
            if ($email === false) {
                $this->email_error = true;
            }

            // Objeto de la clase registrarValidar para llamar a sus funciones
            $objetoValidarRegistrar = new \validarRegistro\RegistrarValidar();
            $email_valid = $objetoValidarRegistrar->valid_email($_POST['email']);
            if ($email_valid === false) {
                $this->email_format = true;
            }
            $password = $objetoValidarRegistrar->compare_password($_POST['password'], $_POST['password1']);
            if ($password === false) {
                $this->password_error = true;
            }
            if ($_POST['department'] == 'default') {
                $this->department_error = true;
            }
            if (!isset($this->password_error) && !isset($this->email_error) && !isset($this->email_format) && !isset($this->department_error)) {
                $datos_usuario = array($_POST['username'], $_POST['email'], $password, $_POST['department']);

                $admin = new \functionsUsers\Admin();
                $anadido = $admin->anadir_usuario($datos_usuario);

                if ($anadido) {
                    //facemos uso do método comprobar_usuario, unha vez foi creado, para coller o seu id
                    $conexion1 = new \functionsUsers\Conexion;
                    $user = $conexion1->comprobar_usuario($_POST['username'], $_POST['password']);

                    $_SESSION['id_user'] = $user[0];
                    $_SESSION['usuario'] = $user[1];
                    $_SESSION['rol'] = $user[2];
                    $_SESSION['create'] = true;
                    
                    $rol=$conexion1->get_name_rol($user[2]);
                    $asunto = 'Cuenta Creada';
                    $correo = new \correo\Correo();
                    $correo->enviar_correo_cuenta_sat($_POST['email'], $asunto, $rol);
                    
                    header("Location: ../../index.php");
                }
            }
        }
    }

}

if (isset($_POST['SignUp'])) {
    $create = new \registrologin\signup();
    $create->create();
    $newaccountblank = $create->newaccountblank;
    $email_error = $create->email_error;
    $email_format = $create->email_format;
    $password_error = $create->password_error;
    $department_error = $create->department_error;
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
                            <p class="title">Crear Cuenta</p>
                        </div>
                        <?php
                        if (isset($newaccountblank) and $newaccountblank == true) {
                            echo "<p style='color: red; font-weight: bold'>Rellena todos os campos</p>";
                        }
                        if (isset($password_error) and $password_error == true) {
                            echo "<p style='color: red; font-weight: bold'>As contrasinais non coinciden</p>";
                        }
                        if (isset($email_error) and $email_error == true) {
                            echo "<p style='color: red; font-weight: bold'>Xa hai un usuario rexistrado con este correo</p>";
                        }
                        if (isset($department_error) and $department_error == true) {
                            echo "<p style='color: red; font-weight: bold'>Selecciona un departamento</p>";
                        }
                        if (isset($email_format) and $email_format == true) {
                            echo "<p style='color: red; font-weight: bold'>Erro no formato do email</p>";
                        }
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img class="icon_navbar" src="../../images/icons/person.svg"
                                                                        alt="icono user"></span>
                                </div>
                                <input type="text" name="username" class="form-control" value="" placeholder="Usuario">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img class="icon_navbar" src="../../images/icons/envelope.svg"
                                                                        alt="icono chave"></span>
                                </div>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" name="email" placeholder="Introducir email">

                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img class="icon_navbar" src="../../images/icons/key.svg"
                                                                        alt="icono chave"></span>
                                </div>
                                <input type="password" name="password" class="form-control" value="" placeholder="Contraseña">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img class="icon_navbar" src="../../images/icons/key.svg"
                                                                        alt="icono chave"></span>
                                </div>
                                <input type="password" name="password1" class="form-control" value=""
                                       placeholder="Confirmar Contraseña">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img class="icon_navbar" src="../../images/icons/tools.svg"
                                                                        alt="icono chave"></span>
                                </div>
                                <select name="department" class="custom-select">
                                    <option value="default" selected>Seleccionar Departamento</option>
                                    <?php
                                    $roles = new \functionsUsers\Conexion();
                                    echo $roles->mostrar_roles_select();
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="SignUp" class="btn login_btn">Crear Cuenta</button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            ¿Ya tienes cuenta? <a href="login.php" class="ml-2">Iniciar Sesión</a>
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