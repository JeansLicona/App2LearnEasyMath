<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author Zero
 */
class Conexion {

    protected $_tipo = 'mysql';
    protected $_servidor = 'localhost';
    protected $_usuario = 'root';
    protected $_password = '';
    public $_pdo = null;
    protected $_esquema="pizarra_virtual";
    protected $_connectionString;

    public function __construct() {
        $this->conectar();
    }

    public function createConnectionString() {
        switch ($this->_tipo) {
            case 'mysql':
                if (!empty($this->_servidor) && !empty($this->_esquema)) {
                    $this->_connectionString = $this->_tipo . ':host=' . $this->_servidor . ';dbname=' . $this->_esquema;
                    return $this->_connectionString;
                }
                else
                    throw new Exception('El parámetro server o el parámetro schema están vacíos');
                break;
            default:
                throw new Exception('Motor de base de datos inexistente');
                break;
        }
        return true;
    }

    public function conectar() {
        $this->_pdo = new PDO($this->createConnectionString(), $this->_usuario, $this->_password);
    }

    public function disconnect() {
        $this->_pdo = null;
    }

    public function __destruct() {
        $this->disconnect();
    }

}

?>
