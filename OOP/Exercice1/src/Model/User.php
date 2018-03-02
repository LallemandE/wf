<?php
namespace Model;

class User {
    
    private $id;		
    protected $roles = [];
    protected $password;
    protected $salt;
    protected $username;
    
    
    public function getId(){
        return $this->id;
    }
    
    public function getRoles(){
        return $this->roles;
    }
    
    
    public function getPassword(){
        return $this->password;
    }
    public function getSalt(){
        return $this->salt;
    }
    public function getUsername(){
        return $this->username;
    }
    
    
    public function setRoles($myRoles){
        $this->roles = $myRoles;
        return $this;
    }
    
    public function setPassword($myPassword){
        $this->password = $myPassword;
        return $this;
    }
    
    public function setSalt($mySalt){
        $this->salt = $mySalt;
        return $this;
    }
    
    
    public function setUsername($myName){
        $this->username = $myName;
        return $this;
    }
    
    
    public function eraseCredentials(){
        $this->salt = NULL;
        $this->password = NULL;
        return $this;
    }
}


?>