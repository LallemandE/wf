<?php

namespace Model;

class Role {
    
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    
    private $id;
    protected $label;
    
    public function __construct($myLabel){
        $this->label = $myLabel;
    }

    /*
    public setId($myId){
        $this-id = $myId;
    }
    */
    
    public function setLabel($myLabel){
        $this->label = $myLabel;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getLabel(){
        return $this->label;
    }
    
    
}