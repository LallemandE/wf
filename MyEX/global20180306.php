<?php

// Si on veut améliorer, il faut créer plusieurs fichiers pour les différentes classes.
// Il serait également souhaitable d'envoyer et de gérer des exceptions quand des paramètres
// sont fournis alors qu'il ne conviennent pas.

namespace myNameSpace;

class Person{
    private $name;
    private $firstname;
    
    public function __construct($name, $firstname){
        $this->name = $name;
        $this->firstname = $firstname;
    }
    
    public function getFirstName(){            //'Firstname'
        return $this->firstname;
    }
    
    public function getName(){                 // 'Name'
        return $this->name;
    }
}

$moi = new Person('LALLEMAND', 'Eric');

$moi->getFirstName();
/*
interface MetadataInterface{
    public function addCorrespondance ($methodName, $resultName);
    public function getAllCorrespondance();
}
*/

class Metadata{
    private $correspondanceArray =[];    
    
    public function addCorrespondance ($methodName, $resultName){
      // si le nom de la méthode existe déjà, il ne faut pas l'ajouter
      // avant d'insérer une nouvelle correspondance, il faut contrôler
      // que le nom de la méthode n'existe pas dans l'array_keys($correspondanceArray)

        if ((! array_key_exists($methodName, $this->correspondanceArray)) &&
            (! in_array($resultName, array_values($this->correspondanceArray)))) {
           $this->correspondanceArray[$methodName] = $resultName ;
      }
      // on peut aussi imaginer que le $résultName ne peut pas lui-même est dans
      // le tableau des valeurs array_values($correspondanceArray)
    }
    
    public function getAllCorrespondance(){
        // => fournit un tableau associatif
        return $this->correspondanceArray;
    }
}

$myMetadata = new Metadata;

$myMetadata->addCorrespondance('getFirstname', 'Firstname');
$myMetadata->addCorrespondance('getName', 'Name');


 interface NormalizerInterface{
     public function objectSet($object);
     public function configurationSet ($configuration);
     public function normalize ();
 }
 



class Normalizer implements NormalizerInterface {
    private $object;
    private $configuration; // un tableau associatif retourné par Metadata
    
    // ajout des setters
    
    public function objectSet($object){
        $this->object = $object;
        return $this;
    }
    
    public function configurationSet ($configuration){
        $this->configuration = $configuration;
        return $this;
    }
    
    public function normalize (){
        // il faut appliquer chacune des méthodes du tableau $configuration
        // le résultat obtenu est envoyé dans un tableau associatif
        $normalizeArray = [];
        foreach($this->configuration as $key => $value){
            $normalizeArray[$value] = $this->object->$key();
        }
        return $normalizeArray;
    }
    
}

$myNormalizer = new Normalizer;
$myNormalizer->objectSet($moi)->configurationSet($myMetadata->getAllCorrespondance());

// var_dump($myNormalizer->normalize());

interface SerializerInterface {
    public const JSON_FORMAT = 'JSON_FORMAT';
    public const PHPNative = 'PHPNative';
    
    public function formatSet($format);
    public function inputSet ($array);
    public function Serialize();
}


class Serializer implements SerializerInterface {
    
    // pour un encodage en Json, il y a la fonction json_encode
    private $outputFormat;
    private $inputArray;

    // => 2 setters
    
    public function formatSet ($format){
        // we can check that the format is autorised. If know => set outputFormat
        if (($format == self::JSON_FORMAT) || ($format == self::PHPNative)){
            $this->outputFormat = $format;
            return $this;
        }
    }
    
    public function inputSet ($array){
        $this->inputArray = $array;
    }
    

    // => une méthode pour sortir le résultat 
    public function Serialize(){
        if ($this->outputFormat == self::JSON_FORMAT){
            return json_encode($this->inputArray);
        }
        if ($this->outputFormat == self::PHPNative){
            return serialize($this->inputArray);
        }
    }
    
}

$mySerializer = new Serializer;

$mySerializer->formatSet('PHPNative');
// $mySerializer->formatSet('JSON_FORMAT');

$mySerializer->inputSet($myNormalizer->normalize());

echo ('Fin de la serialization : ' . "\n");
var_dump ($mySerializer->Serialize());



