<?php
class User {
    private $id;
    private $username;
    private $password;
    private $realname;
    private $realsurname;
    private $phone;
    private $email;
    private $authdate;
    private $rol;
    private $color;
    private $flagactivo;

    public function __construct(){
        $this->logged = false;
    }
    public function SetId($id){
        $this->id = $id;
    }
    public function SetUsername($username){
        $this->username = $username;
    }
    public function SetPassword($password){
        $this->password = $password;
    }
    public function SetRealname($realname){
        $this->realname = $realname;
    }
    public function SetRealsurname($realsurname){
        $this->realsurname = $realsurname;
    }
    public function SetPhone($phone){
        $this->phone = $phone;
    }
    public function SetEmail($email){
        $this->email = $email;
    }
    public function SetAuthdate($authdate){
        $this->authdate = $authdate;
    }
    public function SetRol($rol){
        $this->rol = $rol;
    }
    public function SetColor($color){
        $this->color = $color;
    }
    public function SetFlagActivo($flagactivo){
        $this->flagactivo = $flagactivo;
    }
    public function GetId(){
        return $this->id;
    }
    public function IsFlagActivo(){
        return $this->flagactivo;
    }
    public function GetUsername(){
        return $this->username;
    }
    public function GetPassword(){
        return $this->password;
    }
    public function GetRealname(){
        return $this->realname;
    }
    public function GetRealsurname(){
        return $this->realsurname;
    }
    public function GetPhone(){
        return $this->phone;
    }
    public function GetEmail(){
        return $this->email;
    }
    public function GetAuthdate(){
        return $this->authdate;
    }
    public function GetRol(){
        return $this->rol;
    }
    public function GetColor(){
        return $this->color;
    }
    public function GetFullName(){
        return $this->realname.' '.$this->realsurname;
    }
    public function GetShortFullName(){
        return $this->realname.' '.(substr($this->realsurname, 0, 1).'.');
    }
}
?>