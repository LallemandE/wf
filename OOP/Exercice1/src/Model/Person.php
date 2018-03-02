<?php 

namespace Model;

class Person {
    private $id;
    protected $firstname;
    protected $lastname;
    protected $emails = [];
    
    public function getId (){
        return $this->id;
    }
    
    public function getFirstName(){
        return $this->firstname;
    }
    
    public function getLastname (){
        return $this->lastname;
    }
    
    public function getEmails(){
        return $this->emails;
    }
    
    public function setFirstName ($myName){
        $this->firstname = $myName;
        return $this;
    }
    
    public function setLastname ($myName){
        $this->lastname = $myName; 
        return $this;
    }
    
    public function setEmails ($myEmails){
        $this->emails = $myEmails;
        return $this;
    }
    
}

?>