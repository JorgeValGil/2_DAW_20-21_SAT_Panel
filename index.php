<?php
session_start();
include 'autoload.php';

if (isset($_SESSION['usuario'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <!--icono da páxina-->
            <link rel="icon" type="image/png" href="images/icon.ico">
            <!--arquivos css-->
            <link rel="stylesheet" href="css/index.css">
            <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">>
            <!--título da páxina-->
            <title>SAT Panel</title>
        </head>
        <!--body-->
        <body><div class="container-fluid h-100">
                <div class="row justify-content-center align-items-center text-center panel_superior">
                    <div class="col-2">
                        <a href="index.php"><p class="satpanel">SAT Panel</p></a>
                    </div>

                    <div class='col-2'>
                        <p class='user_rol'><span><img src='images/icons/person-badge-fill.svg' alt='icono user'></span> Usuario: <?php echo $_SESSION['usuario'] ?></p>
                    </div>


                    <div class='col-2'>
                        <p class='user_rol'><span><img src='images/icons/tags-fill.svg' alt='icono rol'></span> Rol: <?php
                            $rol = new \functionsUsers\Conexion();
                            $nombre_rol = $rol->get_name_rol($_SESSION['rol']);
                            echo $nombre_rol
                            ?></p>
                    </div>
                    <?php if ($nombre_rol == 'Tenda') { ?>
                        <div class='col-2 new'>
                            <a href='html/new/cliente.php'><span><img src='images/icons/person-plus-fill.svg' alt='icono nuevo cliente'></span> Nuevo cliente</a>
                        </div>
                        <div class='col-2 new'>
                            <a href='html/new/articulo.php'><span><img src='images/icons/plus-circle-fill.svg' alt='icono nuevo artículo'></span> Nuevo artículo</a>
                        </div>
                    <?php } else {
                        ?>
                        <div class='col-2'>
                        </div>
                        <div class='col-2 new'>
                            <a href='html/edit/profile.php'><span><img src='images/icons/gear-fill.svg' alt='icono number id'></span> Editar perfil</a>
                        </div>
                    <?php }
                    ?>
                    <div class="col-2 logout">
                        <a href="html/registrologin/logout.php"><span><img src="images/icons/power.svg" alt="icono cerrar sesión"></span> Cerrar Sesión</a>
                    </div>
                </div>
                <?php if ($nombre_rol == 'Tenda') { ?>
                    <hr><div class='row justify-content-center align-items-center text-center panel_superior'>
                        <div class='col'>
                            <div class='row'>
                                <div class='col-2 offset-1 new'>
                                    <a href='html/find/dni.php'><span><img src='images/icons/credit-card-2-front-fill.svg' alt='icono card dni'></span> Búsqueda por DNI</a>
                                </div>
                                <div class='col-2 new'>
                                    <a href='html/find/id.php'><span><img src='images/icons/file-binary-fill.svg' alt='icono number id'></span> Búsqueda por ID</a>
                                </div>
                                <div class='col-2 new'>
                                    <a href='html/delete/cliente.php'><span><img src='images/icons/person-x-fill.svg' alt='icono card dni'></span> Borrar cliente</a>
                                </div>
                                <div class='col-2 new'>
                                    <a href='html/delete/articulo.php'><span><img src='images/icons/file-earmark-x-fill.svg' alt='icono number id'></span> Borrar artículo</a>
                                </div>
                                <div class='col-2 new'>
                                    <a href='html/edit/profile.php'><span><img src='images/icons/gear-fill.svg' alt='icono number id'></span> Editar perfil</a>
                                </div>
                            </div>


                        </div>
                    </div>
                    <hr>
                    <?php
                }
                ?>
                <div class="row h-100">
                    <div class="col-2 columna1"><?php
                        $etapa = new \functionsUsers\Conexion();
                        $id = '1';
                        echo $etapa->mostrar_etapa($id);
                        ?>
                        <hr>
                        <?php
                        $articulo = new \functionsUsers\Conexion();
                        $id = '1';
                        echo $articulo->mostrar_articulo($id);
                        ?>
                    </div>
                    <div class="col-2 columna2 columna">
                        <?php
                        $etapa = new \functionsUsers\Conexion();
                        $id = '2';
                        echo $etapa->mostrar_etapa($id);
                        ?>
                        <hr>
                        <?php
                        $articulo = new \functionsUsers\Conexion();
                        $id = '2';
                        echo $articulo->mostrar_articulo($id);
                        ?>
                    </div>
                    <div class="col-2 columna1 columna">
                        <?php
                        $etapa = new \functionsUsers\Conexion();
                        $id = '3';
                        echo $etapa->mostrar_etapa($id);
                        ?>
                        <hr>
                        <?php
                        $articulo = new \functionsUsers\Conexion();
                        $id = '3';
                        echo $articulo->mostrar_articulo($id);
                        ?>
                    </div>
                    <div class="col-2 columna2 columna">
                        <?php
                        $etapa = new \functionsUsers\Conexion();
                        $id = '4';
                        echo $etapa->mostrar_etapa($id);
                        ?>
                        <hr>
                        <?php
                        $articulo = new \functionsUsers\Conexion();
                        $id = '4';
                        echo $articulo->mostrar_articulo($id);
                        ?>
                    </div>
                    <div class="col-2 columna1 columna">
                        <?php
                        $etapa = new \functionsUsers\Conexion();
                        $id = '5';
                        echo $etapa->mostrar_etapa($id);
                        ?>
                        <hr>
                        <?php
                        $articulo = new \functionsUsers\Conexion();
                        $id = '5';
                        echo $articulo->mostrar_articulo($id);
                        ?>
                    </div>
                    <div class="col-2 columna2 columna">
                        <?php
                        $etapa = new \functionsUsers\Conexion();
                        $id = '6';
                        echo $etapa->mostrar_etapa($id);
                        ?>
                        <hr>
                        <?php
                        $articulo = new \functionsUsers\Conexion();
                        $id = '6';
                        echo $articulo->mostrar_articulos_limit($id);
                        ?>
                    </div>
                </div>
            </div>

            <!--arquivos js-->
            <script src="js/jquery.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
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
    <?php
} else {
    header("Location: html/registrologin/login.php");
}
?>
