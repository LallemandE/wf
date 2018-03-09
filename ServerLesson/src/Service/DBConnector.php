<?php
namespace Service;

// C'est une implémentation d'un singleton (pour n'avoir qu'une
// seule connection à la DB ouverte au même moment).

// Pour que la connection soit accessible à tout moments, les données
// sont statics

// La configuraiton et la connection sont statiques pour qu'elles
// ne puissent être accédées que par les getters et setters

class DBConnector
{


    private static $config;
    private static $connection;

    /**
    * Set config
    *
    * Store the given configuration. This configuration must contain
    * a 'host', 'driver', 'dbname', 'dbuser', 'dbpass' keys
    *
    * @param array $config The configuration to Store
    *
    * @return void
    */

    public static function setConfig(array $config){
        self::$config = $config;
    }

    // la méthode suivante est déclarée private car on va uniquement l'appeler avec la méthode
    // getConnection. L'utilisateur ne pourra pas l'appeler => il ne pourra pas ouvrir de connection
    // lui-même => il est forcé de n'en utiliser qu'une seule.


    /**
    * Create a connection
    *
    * Create a live connection with the database and store it
    * internally
    *
    * @return void
    */

    private static function createConnection(){

        $dsn =sprintf('%s:host=%s;dbname=%s',
            self::$config['driver'],
            self::$config['host'],
            self::$config['dbname']);

        self::$connection = new \PDO($dsn, self::$config['dbuser'], self::$config['dbpass'] );
    }


    /**
    * Get connection
    *
    * Return the current existing connection and create it if it données
    * not exists.
    *
    * @return \PDO
    */

    public static function getConnection(){

        if (!self::$connection){
            self::createConnection();
        }

        return self::$connection;
    }

}
