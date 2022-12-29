<?php

namespace functionsUsers;

Class Admin {

    public function __construct() {
        
    }

    function anadir_usuario($datos_usuario) {
        try {
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $sql = 'insert into usuarios(nombre,email,contrasena,rol_usuario) values (?,?,?,?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(
                            array(
                                $datos_usuario[0],
                                $datos_usuario[1],
                                $datos_usuario[2],
                                $datos_usuario[3]
                            )
                    )
            ) {
                return true;
            } else {
                throw new \PDOException();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido añadir el usuario";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
        function updatearticulo($data) {
        try {
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $sql = 'update articulos set titulo=?,'
                    . 'descripcion=?,'
                    . 'comentarios_reparacion=?,'
                    . 'precio=?,'
                    . 'etapa=?'
                    . ' where id=?';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(
                            array(
                                $data[0],
                                $data[1],
                                $data[2],
                                $data[3],
                                $data[4],
                                $data[5]
                            )
                    )
            ) {
                return true;
            } else {
                throw new \PDOException();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha podido actualizar la información del artículo";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
    function create_articulo($datos_articulo) {
        try {
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $sql = 'insert into articulos(titulo,descripcion,precio,cliente,tipo) values (?,?,?,?,?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(
                            array(
                                $datos_articulo[0],
                                $datos_articulo[1],
                                $datos_articulo[2],
                                $datos_articulo[3],
                                $datos_articulo[4]
                            )
                    )
            ) {
                return true;
            } else {
                throw new \PDOException();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido añadir el artículo";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
        function create_cliente($datos_cliente) {
        try {
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $sql = 'insert into clientes(dni,nombre_apellidos,email) values (?,?,?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(
                            array(
                                $datos_cliente[0],
                                $datos_cliente[1],
                                $datos_cliente[2]
                            )
                    )
            ) {
                return true;
            } else {
                throw new \PDOException();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido añadir el cliente";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
    
    
    function insert_modificacion($datos) {
        try {
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $sql = 'insert into log_modificacion(id_articulo,etapa_origen,etapa_destino) values (?,?,?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(
                            array(
                                $datos[0],
                                $datos[1],
                                $datos[2]
                            )
                    )
            ) {
                return true;
            } else {
                throw new \PDOException();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha conseguido añadir la modificacións";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
    
        function delete_cliente($dni) {
        try {
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $sql = 'delete from clientes where dni=?';
            $stmt = $pdo->prepare($sql);
            if (($stmt->execute(array($dni)))) {
                return true;
            } else {
                throw new \PDOException();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error al borrar un cliente";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
    function delete_articulo($id) {
        try {
            $flag = false;
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $pdo->beginTransaction();
            $sql = 'delete from log_modificacion where id_articulo=?';
            $stmt = $pdo->prepare($sql);
            if (!($stmt->execute(array($id)))) {
                $flag = true;
            } else {
                $sql = 'delete from articulos where id=?';
                $stmt = $pdo->prepare($sql);
                if (!($stmt->execute(array($id)))) {
                    $flag = true;
                }
            }
            if (!$flag) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error al borrar un articulo";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }
    
    
    function updatepassword($userdata) {
        try {
            $bd = new \bd\BBDD('admin');
            $pdo = $bd->PDO;
            $sql = 'update usuarios set contrasena=?'
                    . 'where nombre=?';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(
                            array(
                                $userdata[0],
                                $userdata[1]
                            )
                    )
            ) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            echo "Se ha producido un error, no se ha podido actualizar la password del usuario";
        } finally {
            $stmt = null;
            $pdo = null;
        }
    }

}
