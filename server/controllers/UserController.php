<?php
require_once('../config.php');
require_once('../server/controllers/RolController.php');
Tools::init();
class UserController {
    public function findAllCalendarData(){
        $collection = array();
		$sql = Tools::getDB()->query('SELECT id, username, color FROM user WHERE flag_Activo = TRUE');
		if ($res = $sql->fetch_array()) {
            do {
                $user = new User();
                $user->SetId($res['id']);
                $user->SetUsername($res['username']);
                $user->SetColor($res['color']);
                array_push($collection, $user);
			} while($res = $sql->fetch_array());
		}
        return $collection;
    }
    public function findByUsername($username){
        $user = null;
		$sql = Tools::getDB()->query('SELECT id, username, password, phone, realname, realsurname, rol, color, email, auth_date FROM user WHERE flag_Activo = TRUE AND username LIKE "'.strtoupper($username).'"');
		if ($res = $sql->fetch_array()) {
            $user = new User();
			$user->SetId($res['id']);
			$user->SetUsername($res['username']);
			$user->SetPassword($res['password']);
			$user->SetPhone($res['phone']);
			$user->SetRealname($res['realname']);
			$user->SetRealsurname($res['realsurname']);
			$user->SetRol($res['rol']);
			$user->SetColor($res['color']);
			$user->SetEmail($res['email']);
			$user->SetAuthdate($res['auth_date']);
		}
        return $user;
    }
    public function findByUsernameLogin($username){
        $user = null;
		$sql = Tools::getDB()->query('SELECT password FROM user WHERE flag_Activo = TRUE AND username LIKE "'.$username.'"');
		if ($res = $sql->fetch_array()) {
            $user = new User();
			$user->SetPassword($res['password']);
		}
        return $user;
    }
    public function findAllFullName(User $user = NULL){
        $rolController = new RolController();
        $collection = array();
        $query = 'SELECT id, realname, realsurname FROM user WHERE flag_Activo = TRUE';
        $query .= $user != NULL && !$rolController->IsGerente($user) ? ' AND id = '.$user->GetId() : '';
		$sql = Tools::getDB()->query($query);
		if ($res = $sql->fetch_array()) {
            do {
                $usertmp = new User();
                $usertmp->SetId($res['id']);
                $usertmp->SetRealname($res['realname']);
                $usertmp->SetRealsurname($res['realsurname']);
                array_push($collection, $usertmp);
			} while($res = $sql->fetch_array());
		}
        return $collection;
    }
    public function findById($userId) {
        $user = null;
		$sql = Tools::getDB()->query('SELECT id, realname, realsurname FROM user WHERE flag_Activo = TRUE AND id = '.$userId);
		if ($res = $sql->fetch_array()) {
            $user = new User();
            $user->SetId($res['id']);
            $user->SetRealname($res['realname']);
            $user->SetRealsurname($res['realsurname']);
		}
        return $user;
    }
    public function findByIdFullUser($userid) {
        $user = null;
        $sql = Tools::getDB()->query('SELECT id, username, password, phone, realname, realsurname, rol, color, email, auth_date FROM user WHERE flag_Activo = TRUE AND id = ' . $userid);
        if ($res = $sql->fetch_array()) {
            $user = new User();
            $user->SetId($res['id']);
            $user->SetUsername($res['username']);
            $user->SetPassword($res['password']);
            $user->SetPhone($res['phone']);
            $user->SetRealname($res['realname']);
            $user->SetRealsurname($res['realsurname']);
            $user->SetRol($res['rol']);
            $user->SetColor($res['color']);
            $user->SetEmail($res['email']);
            $user->SetAuthdate($res['auth_date']);
        }
        return $user;
    }
    public function findAllConnections(User $user){
        $collection = array();
		$sql = Tools::getDB()->query('SELECT id, id_user, date_login, time_login FROM userlogin WHERE id_user = '.$user->GetId().' ORDER BY id DESC');
		if ($res = $sql->fetch_array()) {
            do {
                $userlog = new UserLogin();
                $userlog->SetId($res['id']);
                $userlog->SetIduser($res['id_user']);
                $userlog->SetDatelogin($res['date_login']);
                $userlog->SetTimelogin($res['time_login']);
                $userlog->SetAuth($this->findByIdFullUser($res['id_user']));
                array_push($collection, $userlog);
			} while($res = $sql->fetch_array());
		}
        return $collection;
    }
    public function signLogin(User $user) {
        $result = false;
		if (Tools::getDB()->query('INSERT INTO userlogin (id_user) VALUES ('.$user->GetId().')')) {
            $result = true;
		}
        return $result;
    }
    public function updatePassword(User $user) {
        $result = false;
		if (Tools::getDB()->query('UPDATE user SET password = "'.$user->GetPassword().'" WHERE id = '.$user->GetId())) {
            $result = true;
		}
        return $result;
    }
    public function updateEmail(User $user) {
        $result = false;
		if (Tools::getDB()->query('UPDATE user SET email = "'.$user->GetEmail().'" WHERE id = '.$user->GetId())) {
            $result = true;
		}
        return $result;
    }
    public function updatePhone(User $user) {
        $result = false;
		if (Tools::getDB()->query('UPDATE user SET phone = "'.$user->GetPhone().'" WHERE id = '.$user->GetId())) {
            $result = true;
		}
        return $result;
    }
    public function updateColor(User $user) {
        $result = false;
        if (Tools::getDB()->query('UPDATE user SET color = "' . $user->GetColor() . '" WHERE id = ' . $user->GetId())) {
            $result = true;
        }
        return $result;
    }
}