<?php

$input;

$nbA = 0;
$nbB = 0;

foreach($input as $singleGame){
    if ($singleGame[0]>$singleGame[1]){
        $nbA++;
    } else if ($singleGame[1]>$singleGame[0]) {
        $nbB++;
    }
}
if ($nbA > $nbB){
    $winner = "A";
} else {
    $winner = "B";
}

echo ($winner);
