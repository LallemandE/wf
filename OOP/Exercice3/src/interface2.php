<?php
 
 interface UserInterface {
    public function getId();
    public function getRoles();
    public function getPassword();
    public function getSalt();
    public function getUsername();
    public function setRoles(array $roles);
    public function addRole(Role $role);
    public function setPassword($password);
    public function setSalt($salt);
    public function setUsername($username);
    public function eraseCredentials();
}
