<?php

/**
 * Classe PDO Oci se basant sur oci8, pour palier à l'extension pdo_oci non disponible
 *
 * @author Dolyveen RENAULT
 */
class PdoOci {

    private $conn;
    private $stmt;

    public function __construct() {

        $this->conn = oci_connect('dev', 'dev', 'localhost/XE');
        if (!$this->conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }

    public function prepare($sql) {
        // Préparation de la requête
        $this->stmt = oci_parse($this->conn, $sql);
        if (!$this->stmt) {
            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }

    public function bindValue($key, $value) {
        oci_bind_by_name($this->stmt, $key, $value);
    }

    public function execute() {
        // Exécution de la logique de la requête
        $r = oci_execute($this->stmt);
        if (!$r) {
            $e = oci_error($this->stmt);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }

    public function fetchAll() {
        return oci_fetch_array($this->stmt, OCI_ASSOC + OCI_RETURN_NULLS);
    }

}

?>
