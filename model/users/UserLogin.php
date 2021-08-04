<?php
class UserLogin {
    private $id;
    private $iduser;
    private $datelogin;
    private $timelogin;
    private $auth;

    public function __construct(){
    }
    public function SetId($id){
        $this->id = $id;
    }
    public function SetIduser($iduser){
        $this->iduser = $iduser;
    }
    public function SetDatelogin($datelogin){
        $this->datelogin = $datelogin;
    }
    public function SetTimelogin($timelogin){
        $this->timelogin = $timelogin;
    }
    public function SetAuth($auth){
        $this->auth = $auth;
    }
    public function GetId(){
        return $this->id;
    }
    public function GetIduser(){
        return $this->iduser;
    }
    public function GetDatelogin(){
        return $this->datelogin;
    }
    public function GetTimelogin(){
        return $this->timelogin;
    }
    public function GetAuth(){
        return $this->auth;
    }
}
?>