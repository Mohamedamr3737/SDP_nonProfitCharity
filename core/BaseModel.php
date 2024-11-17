<?php
class BaseModel {
    protected $db;

    public function __construct($db) {
        $this->db = $db; // Pass database connection to the model
    }

}

?>