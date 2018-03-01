<?php
function divide ($number1, $divisor){
    if ($divisor == 0) {
        throw new RuntimeException('Division by 0 is not allowed');
    }
    return $number1 / $divisor;
}

function arrayDivide($myArray, $divisor){
    $newArray = [];
    try {
        foreach($myArray as $numberToDivide){
            $newArray[] = divide($numberToDivide, $divisor);
            } 
    } catch (RuntimeException $excpt) {$newArray[] = $numberToDivide;}
    return $newArray;
}