<?php
$password;
$salt;

$middleOfPassword = floor(strlen($password)/2);

$debut = substr($password, 0, $middleOfPassword);

$fin = substr($password, $middleOfPassword, strlen($password)-$middleOfPassword);

$saltedPassword = $debut . $salt . $fin;

echo $saltedPassword;
