<?php

$myArray1 = [1,3,6,9];

function myFunctionMultiplyBy2 ($arg)
{
    return $arg*2;
}

array_map('myFunctionMultiplyBy2', $myArray1);

echo "var_dump de l'array apr�s avoir appliqu� la fonction \n";
var_dump($myArray1);

echo "var_dump de l'array retourn� par la fonction \n";
var_dump(array_map('myFunctionMultiplyBy2', $myArray1));

echo "l'array initial n'est donc pas modifi� et le r�sultat de la fonction est un array.\n";


$myStudentArray = ['Eric', 'Sandrine', 'Sedat', 'Serah', 'Leslie', 'Nathalie'];
$nbOfStudInGroup = 3;


// Array_rand g�n�re un set al�atoire de KEY !!!!!

// je veux extraire al�atoirement 2 des �l�ments du tableau pr�c�dent


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



