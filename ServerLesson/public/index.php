<?php 

// р partir du moment o∙ l'on a utilisщ le composer pour gщnщrer l'autoloader, il se trouve dans vendor

require_once __DIR__. '/../vendor/autoload.php;'

// on rщcupшre le fichier de configuration de l'application (il ne doit donc plus apparaюtre dans les "controler" que l'on va "appeler"
$configs = require __DIR__ . '/../config/app.conf.php';


// on ouvre la connexion avec la DB (cela ne doit donc plus ъtre fait dans les "controler" appelщs
use Service\DBconnector;
DBConnector::setConfig($configs['db'];)

// on crщe une table de correspondance
// р l'avenir, pour accщder au contrЇler "account.php" qui se trouve dans src/controler, l'utilisateur va indiquer
//        index.php/account comme URL
// c'est dans le tableau suivant que l'on fait le lien entre ce qui suit "index.php/" et le vrai controler qu'il faut exщcuter.


$map = [
    'account' => __DIR . '/../src/Controller/account.php',
    '' => __DIR__.'/../src/Controller/index.php',
    'register' => __DIR__. '/../src/Controller/register.php'
];

// on rщcupшre l'URI qui a щtщ tapщe par l'utilisateur

$url = $SERVER['REQUEST_URI'];

// ce qui nous intщresse est en fait la partie qui suit "index.php

if (substr($url,0, strlen('/index.php'))== '/index.php'){
    $url=substr($url,strlen('/index.php'))
} else if ($url =="/"){
    $url = '';
}

// si ce qui suit index.php existe dans le tableau de correspondance dщfini ci dessus, on inclus le code de la page correspondante. 

if (array_key_exists ($url, $map)) {
    include $map['url'];


// var_dump($url)

// dans APACHE, je change les rщpertoires pour qu'il aille par dщfaut dans public.


// SI Apache trouve une URL dans une URL, il l'exщcute.

// Si Apache reчoit une URI du type www.salsanews.lu/index.php/quelque_chose_de_plus, il va traiter la page www.salsanews.lu/index.php
// car c'est une URI totalement valide. C'est sur cette base qu'est construit ce programme-ci.

 /* 
    
    Et aprшs ce code, il faut encore enlever l'include de init.php car c'est dщjра fait dans chacune des
    pages inclues.
    
    l'utilisateur est limitщ ра public et il ne peut plus accщder ра des pages qui ne sont pas
    prщvues dans le mapping.
    
    
*/
?>