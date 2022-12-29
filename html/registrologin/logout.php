<?php
session_start();
session_destroy();
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
                        <p class="info">La sesión se ha cerrado correctamente,<br> nos vemos pronto</p>
                        <p class="redirect">Redirigiendo a la página principal ...</p>
                    </div>
                    
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
<?php
header("Refresh:3; url=../../index.php");
?>