<?php

$myArray1 = [1,3,6,9];

function myFunctionMultiplyBy2 ($arg)
{
    return $arg*2;
}

array_map('myFunctionMultiplyBy2', $myArray1);

echo "var_dump de l'array après avoir appliqué la fonction \n";
var_dump($myArray1);

echo "var_dump de l'array retourné par la fonction \n";
var_dump(array_map('myFunctionMultiplyBy2', $myArray1));

echo "l'array initial n'est donc pas modifié et le résultat de la fonction est un array.\n";


$myStudentArray = ['Eric', 'Sandrine', 'Sedat', 'Serah', 'Leslie', 'Nathalie'];
$nbOfStudInGroup = 3;


// Array_rand génère un set aléatoire de KEY !!!!!

// je veux extraire aléatoirement 2 des éléments du tableau précédent


/*

for ($i = 0; $i < 5; $i++){
    echo "Trial " . $i . "\n";
    $randomKeyArray = array_rand($myStudentArray, $nbOfStudInGroup);
    foreach ($randomKeyArray as $myKey){
        echo $myStudentArray[$myKey] . " ";  
    }
    echo "\n";
}
*/

$myArray2 = $myStudentArray;

// do {
    $randomKeyArray = array_rand($myStudentArray, $nbOfStudInGroup);
    foreach ($randomKeyArray as $myKey){
        echo $myStudentArray[$myKey] . " ";
    }
    $arrayKeys = array_keys($randomKeyArray);
    var_dump($arrayKeys);
    
    
// } while (count($myArray2) >0);



