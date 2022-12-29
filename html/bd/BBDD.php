<?php

namespace bd;

class BBDD {

    private $nombre;
    private $password;
    private $servidor;
    private $bd;
    public $PDO;

    public function __construct($rol) {
        try {
            $res = $this->leer_config(__DIR__ . "/../../config/configuracion.xml", __DIR__ . "/../../config/configuracion.xsd", $rol);
            $this->servidor = $res[0];
            $this->bd = $res[1];
            $this->nombre = $res[2];
            $this->password = $res[3];
            $this->PDO = new \PDO("mysql:dbname=" . $this->bd . ";host=" . $this->servidor, $this->nombre, $this->password);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit();
        }
    }

    function leer_config($fichero_config_BBDD, $esquema, $rol) {
        $config = new \DOMDocument();
        $config->load($fichero_config_BBDD);
        $res = $config->schemaValidate($esquema);
        if ($res === FALSE) {
            throw new InvalidArgumentException("Revise el fichero de configuración");
        }
        $datos = simplexml_load_file($fichero_config_BBDD);
        $array = [
            "" . $datos->xpath('//servidor[../rol="' . $rol . '"]')[0],
            "" . $datos->xpath('//bd[../rol="' . $rol . '"]')[0],
            "" . $datos->xpath('//nombre[../rol="' . $rol . '"]')[0],
            "" . $datos->xpath('//password[../rol="' . $rol . '"]')[0]
        ];

        return $array;
    }

}
