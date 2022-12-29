<?php
session_start();
include '../../autoload.php';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($_GET['articulo'])) {
    $id = $_GET['articulo'];
    $conexion = new \functionsUsers\Conexion();
    $etapa = $conexion->get_etapa($id);
    if (isset($_POST['Guardar'])) {

        $etapa_original = $conexion->get_etapa($id);

        if ($etapa_original != '') {
            $titulo_guardar = $_POST['titulo'];
            $etapa_guardar = $_POST['selector_etapa'];
            $descripcion_guardar = $_POST['descripcion'];
            $comentario_guardar = $_POST['comentario'];
            $precio_guardar = $_POST['precio'];

            $datos_guardar = array($titulo_guardar, $descripcion_guardar, $comentario_guardar, $precio_guardar, $etapa_guardar, $id);

            $guardar = new \functionsUsers\Admin();
            $guardar->updatearticulo($datos_guardar);
            $datos_modificacion = array($id, $etapa_original, $etapa_guardar);
            if ($etapa_original != $etapa_guardar) {
                $guardar->insert_modificacion($datos_modificacion);
                $email_cliente = $conexion->get_email_articuloid($id);
                $correo = new \correo\Correo();
                switch ($etapa_guardar) {
                    case 'Pendiente Cliente':
                        $asunto = 'Información importante sobre su reparación.';
                        $correo->enviar_correo_pendente_cliente($email_cliente, $asunto);
                        break;
                    case 'Pendiente Pieza':
                        $asunto = 'Información sobre su reparación.';
                        $correo->enviar_correo_peza($email_cliente, $asunto);
                        break;
                    case 'Finalizado':
                        $asunto = 'Reparación Finalizada!';
                        $correo->enviar_correo_finalizado($email_cliente, $asunto, $precio_guardar);
                        break;
                }
            }
        }

        header("Location: ../../index.php");
    }
}

if (!isset($_SESSION['usuario']) || !isset($_GET['articulo'])) {
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
                    <p>ID: <?php
                        echo $id;
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
                    <form  action="<?php echo $actual_link; ?>" method = "POST">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="titulo"><span><img src="../../images/icons/fonts.svg" alt="icono título"></span> Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       placeholder="Título del artículo" value="<?php
                                       $titulo = new \functionsUsers\Conexion();
                                       $titulo_string = $titulo->get_titulo($id);
                                       echo $titulo_string;
                                       ?>">
                            </div>
                            <div class="col-6">
                                <label for="selector_etapa"><span><img src="../../images/icons/list-check.svg" alt="icono etapa"></span> Etapa:</label>
                                <select class="form-control" id="selector_etapa" name="selector_etapa">
                                    <?php
                                    $etapas = new \functionsUsers\Conexion();
                                    echo $etapas->mostrar_etapas_seleccionadas($id);
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="descripcion"><span><img src="../../images/icons/info.svg" alt="icono descripción"></span> Descripción: </label>
                                <textarea class="form-control" id="descripcion" name="descripcion"><?php
                                    $descripcion = new \functionsUsers\Conexion();
                                    $descripcion_string = $descripcion->get_descripcion($id);
                                    echo $descripcion_string;
                                    ?></textarea>
                            </div>
                            <div class="col-6">
                                <p><span><img src="../../images/icons/person-fill.svg" alt="icono cliente"></span> Cliente:</p>
                                <p><?php
                                    $clientes = new \functionsUsers\Conexion();
                                    $cliente = $clientes->get_cliente($id);
                                    echo $cliente;
                                    ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="comentario"><span><img src="../../images/icons/card-text.svg" alt="icono comentario"></span> Comentario Reparación</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="5"><?php
                                    $comentario = new \functionsUsers\Conexion();
                                    echo $comentario->get_comentario($id);
                                    ?></textarea>
                            </div>
                            <div class="col-6">
                                <label for="precio"><span><img src="../../images/icons/server.svg" alt="icono precio"></span> Precio: </label><br>

                                <input type="number" id="precio" name="precio" min="0" step="0.01" value="<?php
                                $precio = new \functionsUsers\Conexion();
                                $precio_string = $precio->get_precio($id);
                                echo $precio_string;
                                ?>"><span>€</span>
                                       <?php if ($_SESSION['rol'] == '1') { ?>
                                    <br> 
                                    <div class="lista_etapas">
                                        <a href="../log/etapas.php?articulo=<?php echo $id; ?>"><span><img src="../../images/icons/stopwatch-fill.svg" alt="icono reloj"></span> Ver historial de etapas</a>
                                    </div>
                                    <br> 
                                    <div class="imprimir">
                                        <button onclick="imprimir()">Imprimir ticket</button>    
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <?php
                        if ($_SESSION['rol'] == '1') {
                            if ($etapa == 'Pendiente Cliente') {
                                ?><div class='form-group row justify-content-center'>
                                    <button type='submit' name='Guardar' class='btn login_btn' ><span><img src='../../images/icons/save-fill.svg' alt='icono guardar'></span> Guardar Cambios</button>
                                </div><?php
                            } else {
                                ?><p class='aviso'>Usuario con rol Tenda. Vista de só lectura.</p><?php
                            }
                        } else {
                            ?>
                            <div class='form-group row justify-content-center'>
                                <button type='submit' name='Guardar' class='btn login_btn' ><span><img src='../../images/icons/save-fill.svg' alt='icono guardar'></span> Guardar Cambios</button>

                            </div>
                        <?php }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function imprimir() {
                myWindow = window.open('', '', 'width=500,height=250');
                myWindow.document.write("<p>ID: <?php echo $id; ?></p><hr><p><?php echo $titulo_string; ?></p><hr><p>Descripción: <?php echo $descripcion_string; ?></p><hr><p><?php echo $cliente; ?></p><p><?php if ($etapa != 'En espera - Tienda') {

                            echo 'Precio '.$precio_string.'€';
                        }
                        ?></p>");
                myWindow.document.close();
                myWindow.print();
            }
        </script>
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
