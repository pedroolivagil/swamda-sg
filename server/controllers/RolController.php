<?php
require_once('../config.php');
Tools::init();
class RolController {
    public function isGerente(User $user){
        $result = false;
		$sql = Tools::getDB()->query('SELECT id FROM rol WHERE name = "Gerente"');
		if ($res = $sql->fetch_array()) {
            $result = $res['id'] == $user->GetRol();
		}
        return $result;
    }
    public function isEmpleado(User $user){
        $result = false;
		$sql = Tools::getDB()->query('SELECT id FROM rol WHERE name = "Empleado"');
		if ($res = $sql->fetch_array()) {
            $result = $res['id'] == $user->GetRol();
		}
        return $result;
    }
}