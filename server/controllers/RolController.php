<?php
class RolController {
    private $roles;
    const EMPLEADO = "Empleado";
    const GERENTE = "Gerente";
    const ADMINISTRADOR = "Administrador";

    public function __construct() {
        $this->roles = array();
        $sql = Tools::getDB()->query('SELECT id, name FROM ' . _TROL_);
        while ($res = $sql->fetch_array()) {
            array_push($this->roles, new Rol(intval($res['id']), $res['name']));
        }
    }

    private function _getRol($userRol) {
        $rol = NULL;
        foreach ($this->roles as $key => $roltmp) {
            if ($roltmp->GetId() == $userRol) {
                $rol = $key;
            }
        }
        return $rol;
    }

    public function isGerente(User $user) {
        $rol = $this->roles[$this->_getRol($user->GetRol())];
        return array_search($rol->GetName(), array(self::GERENTE, self::ADMINISTRADOR)) !== false;
    }
    public function isAdministrador(User $user) {
        $rol = $this->roles[$this->_getRol($user->GetRol())];
        return array_search($rol->GetName(), array(self::ADMINISTRADOR)) !== false;
    }
    public function isEmpleado(User $user) {
        $rol = $this->roles[$this->_getRol($user->GetRol())];
        return array_search($rol->GetName(), array(self::GERENTE, self::ADMINISTRADOR)) === false;
    }
}
