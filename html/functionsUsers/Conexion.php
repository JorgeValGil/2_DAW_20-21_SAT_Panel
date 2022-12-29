<?php

namespace functionsUsers;

Class Conexion {

    public function __construct() {
        
    }

    function comprobar_usuario($nombre, $clave) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select id, nombre, contrasena, rol_usuario from usuarios where nombre=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($nombre))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    $id = $fila['id'];
                    $nombre = $fila['nombre'];
                    $hash = $fila['contrasena'];
                    $rol = $fila['rol_usuario'];

                    if (password_verify($clave, $hash)) {
                        return array($id, $nombre, $rol);
                    } else {
                        return false;
                    }
                }
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han conseguido leer los datos del usuario.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function comprobar_email($email) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = 'select email from usuarios where email=?';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array(
                        $email[0]
                    ))) {
                if ($stmt->rowCount() != 0) {
                    return false;
                } else {
                    return true;
                }
            } else {
                throw new \PDOException();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido comprobar el email.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_etapa($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select nombre from etapas where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return "<p class='etapa'>" . $fila['nombre'] . "</p>";
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han conseguido mostrar los nombres de etapa.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function getPassword($nombre) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = 'select contrasena from usuarios where nombre=?';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($nombre))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila[0];
                }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido cargar los datos de usuario";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_articulo($id) {
        try {
            $html = '';
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select a.id as id_articulo, a.titulo, t.color from articulos as a 
inner join tipos_articulo as t on a.tipo=t.nombre 
inner join etapas as e on a.etapa=e.nombre where e.id=? order by id_articulo asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($id));
            $filas = $stmt->fetchAll();
            foreach ($filas as $fila) {
                $id_articulo = $fila['id_articulo'];
                $titulo = $fila['titulo'];
                $color = $fila['color'];

                $html .= "<a class='link_articulo' href='html/edit/articulo.php?articulo=$id_articulo'><div class='articulo' style='background-color: $color;'>
	<p class='id_articulo'>$id_articulo</p>
	<p class='nombre_articulo'>$titulo</p>
</div></a>";
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han conseguido mostrar los artículos.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    function mostrar_articulos_limit($id) {
        try {
            $html = '';
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select a.id as id_articulo, a.titulo, t.color from articulos as a 
inner join tipos_articulo as t on a.tipo=t.nombre 
inner join etapas as e on a.etapa=e.nombre where e.id=? order by id_articulo desc limit 10";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($id));
            $filas = $stmt->fetchAll();
            foreach ($filas as $fila) {
                $id_articulo = $fila['id_articulo'];
                $titulo = $fila['titulo'];
                $color = $fila['color'];

                $html .= "<a class='link_articulo' href='html/edit/articulo.php?articulo=$id_articulo'><div class='articulo' style='background-color: $color;'>
	<p class='id_articulo'>$id_articulo</p>
	<p class='nombre_articulo'>$titulo</p>
</div></a>";
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han conseguido mostrar los artículos.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
    function get_name_rol($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select nombre_rol from roles where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['nombre_rol'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido obtener los nombres de los roles.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_roles_select() {
        $html = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select id, nombre_rol from roles";
            $stmt = $pdo->query($sql);
            if ($stmt->execute()) {
                $filas = $stmt->fetchAll();
                foreach ($filas as $fila) {
                    $id = $fila['id'];
                    $nombre_rol = $fila['nombre_rol'];
                    $html .= "<option value='$id'>$nombre_rol</option>";
                }
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los roles.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_etapa($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select etapa from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['etapa'];
                } else {
                    return '';
                }
            } else {
                return '';
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido el nombre de la etapa.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_etapas_seleccionadas($id) {
        $html = '';
        try {
            $nombre_etapa = $this->get_etapa($id);
            if ($nombre_etapa != '') {
                $bd = new \bd\BBDD('conexion');
                $pdo = $bd->PDO;
                $sql = "select * from etapas order by id asc";
                $stmt = $pdo->query($sql);
                if ($stmt->execute()) {
                    $filas = $stmt->fetchAll();
                    foreach ($filas as $fila) {
                        $id = $fila['id'];
                        $nombre = $fila['nombre'];
                        if ($nombre == $nombre_etapa) {
                            $html .= "<option value='$nombre' selected>$nombre</option>";
                        } else {
                            $html .= "<option value='$nombre'>$nombre</option>";
                        }
                    }
                }
                return $html;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los roles.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_titulo($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select titulo from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['titulo'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido el titulo del artículo.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_descripcion($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select descripcion from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['descripcion'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido la descripción del artículo.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_comentario($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select comentarios_reparacion from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['comentarios_reparacion'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido los comentarios del artículo.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_precio($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select precio from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['precio'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido el precio del artículo.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_cliente($id) {
        $texto = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select cliente from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    $cliente = $fila['cliente'];

                    $sql1 = "select * from clientes where dni=?";
                    $stmt1 = $pdo->prepare($sql1);
                    if ($stmt1->execute(array($cliente))) {
                        $resultado = $stmt1->fetch();
                        if ($resultado) {
                            $texto .= 'Nombre: ' . $resultado['nombre_apellidos'] . '<br>DNI: ' . $resultado['dni'] . '<br> E-mail: ' . $resultado['email'];
                        }
                    }
                }
            }
            return $texto;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido el nombre de la etapa.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_clientes_seleccionadas($id) {
        $html = '';
        try {
            $dni_cliente = $this->get_cliente($id);
            if ($dni_cliente != '') {
                $bd = new \bd\BBDD('conexion');
                $pdo = $bd->PDO;
                $sql = "select dni, nombre_apellidos from clientes order by dni asc";
                $stmt = $pdo->query($sql);
                if ($stmt->execute()) {
                    $filas = $stmt->fetchAll();
                    foreach ($filas as $fila) {
                        $dni = $fila['dni'];
                        $nombre = $fila['nombre_apellidos'];
                        if ($dni == $dni_cliente) {
                            $html .= "<option value='$dni' selected>$dni - $nombre</option>";
                        } else {
                            $html .= "<option value='$dni'>$dni - $nombre</option>";
                        }
                    }
                }
                return $html;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los roles.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_tipos_articulo() {
        $html = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select nombre from tipos_articulo order by id asc";
            $stmt = $pdo->query($sql);
            if ($stmt->execute()) {
                $filas = $stmt->fetchAll();
                foreach ($filas as $fila) {
                    $nombre = $fila['nombre'];
                    $html .= "<option value='$nombre'>$nombre</option>";
                }
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los tipos.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_clientes() {
        $html = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select * from clientes order by dni asc";
            $stmt = $pdo->query($sql);
            if ($stmt->execute()) {
                $filas = $stmt->fetchAll();
                foreach ($filas as $fila) {
                    $dni = $fila['dni'];
                    $nombre = $fila['nombre_apellidos'];
                    $email = $fila['email'];
                    $html .= "<option value='$dni'>DNI: $dni - Nombre: $nombre - Email: $email</option>";
                }
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los clientes.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_hora($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select hora from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['hora'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido obtener la hora de creación.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_modificaciones($id) {
        $html = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select * from log_modificacion where id_articulo=? order by id asc";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $filas = $stmt->fetchAll();
                foreach ($filas as $fila) {
                    $etapa_origen = $fila['etapa_origen'];
                    $etapa_destino = $fila['etapa_destino'];
                    $hora = $fila['hora'];
                    $html .= "<tr><td>$hora</td><td>$etapa_origen</td><td>$etapa_destino</td></tr>";
                }
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los clientes.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_articulos_dni($dni) {
        $html = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select id, titulo from articulos where cliente=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($dni))) {
                $filas = $stmt->fetchAll();
                foreach ($filas as $fila) {
                    $id = $fila['id'];
                    $titulo = $fila['titulo'];
                    $html .= "<li><a href='../edit/articulo.php?articulo=$id'>$titulo</a></li>";
                }
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los clientes.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_articulo_id($id) {
        $html = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select id, titulo from articulos where id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $filas = $stmt->fetchAll();
                foreach ($filas as $fila) {
                    $id = $fila['id'];
                    $titulo = $fila['titulo'];
                    $html .= "<li><a href='../edit/articulo.php?articulo=$id'>$titulo</a></li>";
                }
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los clientes.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_count_articulos_cliente($dni) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select count(*) from articulos where cliente=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($dni))) {
                $fila = $stmt->fetch();
                return $fila[0];
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido obtener la hora de creación.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function mostrar_articulos() {
        $html = '';
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select id, titulo from articulos";
            $stmt = $pdo->query($sql);
            if ($stmt->execute()) {
                $filas = $stmt->fetchAll();
                foreach ($filas as $fila) {
                    $id = $fila['id'];
                    $titulo = $fila['titulo'];
                    $html .= "<option value='$id'>ID: $id - $titulo</option>";
                }
            }
            return $html;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido mostrar los clientes.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

    function get_email_articuloid($id) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select c.email as email from articulos as a inner join clientes as c on a.cliente=c.dni where a.id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($id))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['email'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido el email.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
    function get_email_user($nombre) {
        try {
            $bd = new \bd\BBDD('conexion');
            $pdo = $bd->PDO;
            $sql = "select email from usuarios where nombre=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(array($nombre))) {
                $fila = $stmt->fetch();
                if ($fila) {
                    return $fila['email'];
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se han obtenido el email.";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
}
