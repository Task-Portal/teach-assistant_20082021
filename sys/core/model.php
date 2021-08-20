<?php

namespace sys\core;

use \sys\lib\Provider as Provider;

class Model extends Provider {

    public function execute_dml_query($sql, $params = []) {
        if (count($params) === 0) {
            $this->conn->query($sql);
            //echo('<h3>execute_dml_query()-without_params >> OK!</h3>');
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            //echo('<h3>execute_dml_query()-with_params >> OK!</h3>');
        }
    }

    public function execute_select_query($sql, $params = []) {
        if (count($params) === 0) {
            $stmt = $this->conn->query($sql);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function test() {
        echo('<h3>Model-OK!</h3>');
        print_r($this->conn);
    }
}