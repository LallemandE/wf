<?php 

// � partir du moment o� l'on a utilis� le composer pour g�n�rer l'autoloader, il se trouve dans vendor

require_once __DIR__. '/../vendor/autoload.php';

// on r�cup�re le fichier de configuration de l'application (il ne doit donc plus appara�tre dans les "controler" que l'on va "appeler"

$configs = require __DIR__ . '/../config/app.conf.php';


// on ouvre la connexion avec la DB (cela ne doit donc plus �tre fait dans les "controler" appel�s
use Service\DBconnector;
DBConnector::setConfig($configs['db']);

// on cr�e une table de correspondance
// � l'avenir, pour acc�der au contr�ler "account.php" qui se trouve dans src/controler, l'utilisateur va indiquer
//        index.php/account comme URL
// c'est dans le tableau suivant que l'on fait le lien entre ce qui suit "index.php/" et le vrai controler qu'il faut ex�cuter.


$map = [
    '/account' => __DIR__ . '/../src/Controller/accountnew.php',
    '' => __DIR__ . '/../src/Controller/index.php',
    '/register' => __DIR__. '/../src/Controller/registernew.php'
];

// on r�cup�re l'URI qui a �t� tap�e par l'utilisateur

$url = $_SERVER['REQUEST_URI'];


/*
echo "url = " ;
var_dump ($url);
echo "<br>";
*/

// ce qui nous int�resse est en fait la partie qui suit "index.php


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


// J'ai encore un petit soucis avec ce code dans la mesure o� l'utilisateur pourrait d�j� fournir des arguments dans le $_GET =>
// Il faut que je récupère ce qui précède le ? possible de l'URI et c'est cette premi�re partie qui constitue la cl� de recherche dans la table de routage (map)

$requested_url = explode('?', $url, 2);



// si ce qui suit index.php existe dans le tableau de correspondance d�fini ci dessus, on inclus le code de la page correspondante. 

if (array_key_exists ($requested_url[0], $map)) {
    include $map[$requested_url[0]];
}


// var_dump($url)

// dans APACHE, je change les r�pertoires pour qu'il aille par d�faut dans public.


// SI Apache trouve une URL dans une URL, il l'ex�cute.

// Si Apache re�oit une URI du type www.salsanews.lu/index.php/quelque_chose_de_plus, il va traiter la page www.salsanews.lu/index.php
// car c'est une URI totalement valide. C'est sur cette base qu'est construit ce programme-ci.

 /* 
    
    Et apr�s ce code, il faut encore enlever l'include de init.php car c'est d�j� fait dans chacune des
    pages inclues.
    
    l'utilisateur est limit� � public et il ne peut plus acc�der � des pages qui ne sont pas
    pr�vues dans le mapping.
    
    
*/
?>