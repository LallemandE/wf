<?php 

// à partir du moment où l'on a utilisé le composer pour générer l'autoloader, il se trouve dans vendor

require_once __DIR__. '/../vendor/autoload.php';

// on récupère le fichier de configuration de l'application (il ne doit donc plus apparaître dans les "controler" que l'on va "appeler"

$configs = require __DIR__ . '/../config/app.conf.php';


// on ouvre la connexion avec la DB (cela ne doit donc plus être fait dans les "controler" appelés
use Service\DBconnector;
DBConnector::setConfig($configs['db']);

// on crée une table de correspondance
// à l'avenir, pour accéder au contrôler "account.php" qui se trouve dans src/controler, l'utilisateur va indiquer
//        index.php/account comme URL
// c'est dans le tableau suivant que l'on fait le lien entre ce qui suit "index.php/" et le vrai controler qu'il faut exécuter.


$map = [
    '/account' => __DIR__ . '/../src/Controller/accountnew.php',
    '' => __DIR__ . '/../src/Controller/index.php',
    '/register' => __DIR__. '/../src/Controller/registernew.php'
];

// on récupère l'URI qui a été tapée par l'utilisateur

$url = $_SERVER['REQUEST_URI'];


/*
echo "url = " ;
var_dump ($url);
echo "<br>";
*/

// ce qui nous intéresse est en fait la partie qui suit "index.php


if (substr($url,0, strlen('/index.php')) == '/index.php'){
    $url=substr($url, strlen('/index.php'));
} else if ($url == "/"){
    $url = '';
}


/*
echo "url = " ;
var_dump ($url);
echo "<br>";
*/


// J'ai encore un petit soucis avec ce code dans la mesure où l'utilisateur pourrait déjà fournir des arguments dans le $_GET =>
// Il faut que je récupère ce qui précède le ? possible de l'URI et c'est cette première partie qui constitue la clé de recherche dans la table de routage (map)

$requested_url = explode('?', $url, 2);



// si ce qui suit index.php existe dans le tableau de correspondance défini ci dessus, on inclus le code de la page correspondante. 

if (array_key_exists ($requested_url[0], $map)) {
    include $map[$requested_url[0]];
}


// var_dump($url)

// dans APACHE, je change les répertoires pour qu'il aille par défaut dans public.


// SI Apache trouve une URL dans une URL, il l'exécute.

// Si Apache reçoit une URI du type www.salsanews.lu/index.php/quelque_chose_de_plus, il va traiter la page www.salsanews.lu/index.php
// car c'est une URI totalement valide. C'est sur cette base qu'est construit ce programme-ci.

 /* 
    
    Et après ce code, il faut encore enlever l'include de init.php car c'est déjà  fait dans chacune des
    pages inclues.
    
    l'utilisateur est limité à  public et il ne peut plus accéder à  des pages qui ne sont pas
    prévues dans le mapping.
    
    
*/
?>