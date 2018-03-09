<?php 

require_once __DIR__. '/../vendor/autoload.php;'
$configs = require __DIR__ . '/../config/app.conf.php';

use Service\DBconnector;

DBConnector::setConfig($configs['db'];)


$map = [
    'account' => __DIR . '/../src/Controller/account.php',
    '' => __DIR__.'/../src/Controller/index.php',
    'register' => __DIR__. '/../src/Controller/register.php'
];


$url = $SERVER['REQUEST_URI'];


if (substr($url,0, strlen('/index.php'))== '/index.php'){
    $url=substr($url,strlen('/index.php'))
} else if ($url =="/'){
    $url = '';
}


if (array_key_exists ($url, $map)) {
    include $map['url'];


var_dump($url)

// dans APACHE, je change les répertoires pour qu'il aille par défaut dans public.


// SI Apache trouve une URL dans une URL, il l'exécute.

 /* 
    
    Et après ce code, il faut encore enlever l'include de init.php car c'est déjà fait dans chacune des
    pages inclues.
    
    l'utilisateur est limité à public et il ne peut plus accéder à des pages qui ne sont pas
    prévues dans le mapping.
    
    
*/
?>