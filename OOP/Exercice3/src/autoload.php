<?php

spl_autoload_register(
    function ($namespace){
        $filename = sprintf('%s/%s.php',
                            __DIR__, 
                            str_replace('\\', DIRECTORY_SEPARATOR, $namespace));
        echo $filename . "\n";
        
        
        // cette ligne permet de ne faire l'import que si le fichier existe.
        // sans cette ligne, il pourrait y avoir une exception qui empêcherait d'autres
        //fonction d'autoloading d'essayer de charger le fichier nécessaire.
        
        if (is_file($filename)){
            require_once $filename;
        }
    }
    );


use Model\Role;
use Model\User;
use Model\Person;

$user = new User();

$role = new Role(Role::ROLE_USER);


$user->setPassword ('myPassword')
    ->setRoles([$role])
    ->setSalt('mySalt')
    ->setUsername('myUsername');


$person = new Person();
$person->setFirstname('Eric')
    ->setLastname('Montecalvo')
    ->setEmails(['eric.montecalvo@example.org']);