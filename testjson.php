<?php

$provaj = new stdClass();
$provaj ->name = 'Manio';
$provaj ->age = 49;

$myjson = json_encode($provaj);

echo $myjson;

?>