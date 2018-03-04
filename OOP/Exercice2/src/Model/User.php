<?php
namespace Model;

class User
{
    private $id;
    protected $roles = [];
    protected $password;
    protected $salt;
    protected $username;
    
    public function getId()
    {
        return $this->id;
    }

    public function getRoles()
    {
        // The getRoles() method must return a set of Role labels and not a set of Roles
        
        // array_map est une fonction qui utilise deux arguments :
        // - une fonction
        // - un tableau
        // array_map va appliquer la fonction à tous les éléments du tableau et retourner un tableau.
        
        // [$this, 'roleToLabel'] fait référence à la méthode 'roleToLabel' de la classe $this
        
        
        $myRoleArray = array_map ( [$this, 'roleToLabel']  , $this->roles);
        
        // The getRoles() method must allays return the 'ROLE_USER' in the set of roles
        // Il faut donc encore vérifier que ROLE_USER est bien contenu dans le tableau obtenu
        // Si non, il faut l'ajouter.
        
        if (! in_array(Role::ROLE_USER, $myRoleArray)){
            array_push ($myRoleArray,Role::ROLE_USER);
        }
        
        
        return $myRoleArray;
    }
    
    protected function roleToLabel(Role $myRole){
        return $myRole->getLabel();
    }
    

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }
    
    // A method "addRole" must be added
    
    
    public function addRole(Role $additionalRole){
        if (! in_array($additionalRole, $this->roles)){
            array_push($this->roles, $additionalRole);
        }
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function eraseCredentials()
    {
        $this->password = null;
        $this->salt = null;
    }
}

