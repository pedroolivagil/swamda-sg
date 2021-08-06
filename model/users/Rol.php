<?php

class Rol {
    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function GetId() {
        return $this->id;
    }
    public function GetName() {
        return $this->name;
    }
}
