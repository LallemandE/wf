<?php

// Je vais avoir besoin du service permettant l'accès à la DB

require_once __DIR__. '/../Service/DBConnector.php';

// On récupère la configuration globale de l'application
// dont on va envoyer une partie (la partie "db" au DBConnector).
$configs = require_once __DIR__ .'/../../config/app.conf.php';

// On indique que l'on va utiliser le DBConnector qui est dans le namespace "Service"
use Service\DBConnector;

//
// On fournit au service DBConnector les données de configuration dont il a besoin.
//

Service\DBConnector::setConfig($configs['db']);


// A ce niveau, la connection n'est pas ouverte. Le DBConnecteur dispose néanmoins déjà de la configuration
// dont il a besoin si une ouverture est requise.
?>
