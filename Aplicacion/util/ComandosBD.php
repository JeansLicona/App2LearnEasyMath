<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comandos
 *
 * @author Zero
 */
include_once 'Conexion.php';

class ComandosBD {

    protected $_parametros = array();
    protected $_conexion;
    protected $_sentencia;
    protected $_query;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $this->_conexion = new Conexion();
    }
    
     public function buildQuery($query) {
        $sql = 'SELECT ';
        $sql.= (empty($query['select'])) ? '*' : $query['select'];

        if (!empty($query['from']))
            $sql.= "\nFROM " . $query['from'];
        else
            throw new Exception('El query debe contener el from');

        if (!empty($query['join']))
            $sql.="\n" . (is_array($query['join']) ? implode("\n", $query['join']) : $query['join']);

        if (!empty($query['where']))
            $sql.="\nWHERE " . $query['where'];

        if (!empty($query['group']))
            $sql.="\nGROUP BY " . $query['group'];

        if (!empty($query['having']))
            $sql.="\nHAVING " . $query['having'];

        if (!empty($query['union']))
            $sql.="\nUNION (\n" . (is_array($query['union']) ? implode("\n) UNION (\n", $query['union']) : $query['union']) . ')';

        if (!empty($query['order']))
            $sql.="\nORDER BY " . $query['order'];

        if (!empty($query['limit']))
            $sql.="\nLIMIT " . $query['limit'];

        return $sql;
    }

    public function query($query = array()) {
        if (!empty($query)) {
            $sql = $this->buildQuery($query);
            $this->_sentencia = $this->_conexion->_pdo->prepare($sql);
            $params = array();
            if (!empty($query['params']) && is_array($query['params']))
                $params = $query['params'];
            $this->_sentencia->execute($params);
            return $this->_sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            throw new Exception('Se debe definir el query que se desea ejecutar');
    }

    /**
     * Creates and executes an INSERT SQL statement.
     * The method will properly escape the column names, and bind the values to be inserted.
     * @param string $table the table that new rows will be inserted into.
     * @param array $columns the column data (name=>value) to be inserted into the table.
     * @return integer number of rows affected by the execution.
     */
    public function insert($table, $columns) {
        if (!empty($table) && !empty($columns) && is_array($columns)) {
            $sql = "INSERT INTO " . $table;
            $sql .= " (`" . implode("`, `", array_keys($columns)) . "`)";
            $sql .= " VALUES ('" . implode("', '", $columns) . "') ";
            $this->_sentencia = $this->_conexion->_pdo->prepare($sql);
            $values = array();
            $names = array();
            foreach ($columns as $name => $value) {
                $names[] = ':' . $name;
                $values[':' . $name] = $value;
            }
            if ($this->_sentencia->execute($values)) {
                return $this->_sentencia->rowCount();
            }
        }
        else
            throw new Exception('Error en los datos ingresados');
    }
/**
     * Creates and executes an UPDATE SQL statement.
     * The method will properly escape the column names and bind the values to be updated.
     * @param string $table the table to be updated.
     * @param array $columns the column data (name=>value) to be updated.
     * @param mixed $conditions the conditions that will be put in the WHERE part. Please
     * refer to {@link where} on how to specify conditions.
     * @param array $params the parameters to be bound to the query.
     * @return integer number of rows affected by the execution.
     */
    public function update($table, $columns, $conditions = '', $params = array()) {
        if (!empty($table) && !empty($columns) && is_array($columns) &&
                !empty($params) && is_array($params)) {
            $data = array();
            $values = array();
            foreach ($columns as $name => $value) {
                $data[] = $name . '=:' . $name;
                $values[':' . $name] = $value;
            }
            $sql = "UPDATE " . $table;
            $sql .= " SET " . implode(", ", $data) . "";
            if ($conditions != '') {
                $sql.=' WHERE ' . $conditions;
            }
            $this->_sentencia = $this->_conexion->_pdo->prepare($sql);
            $params = array_merge($values, $params);
            if ($this->_sentencia->execute($params)) {
                return $this->_sentencia->rowCount();
            }
        }
        else
            throw new Exception('Error en los datos ingresados');
    }

    /**
     * Return the last inserted ID.
     * @return integer inserted ID.
     */
    public function lastInsertedId($table) {
        if ($table !== null) {
            return $this->_conexion->_pdo->lastInsertId($table);
        }
        return null;
    }

    public function delete($table, $conditions = '', $params = array()) {
        $sql = "DELETE FROM " . $table;
        if ($conditions != '') {
            $sql.=" WHERE " . $conditions;
        }
        $this->_sentencia = $this->_conexion->_pdo->prepare($sql);

        if ($this->_sentencia->execute($params)) {
            return $this->_sentencia->rowCount();
        }
    }
    
    
    public function beginTransaction() {
        $this->_conexion->_pdo->beginTransaction();
    }

    public function commit() {
        $this->_conexion->_pdo->commit();
    }

    public function rollback() {
        $this->_conexion->_pdo->rollBack();
    }

}

?>
