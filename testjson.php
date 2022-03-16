<?php

$obj = $_POST['name'];

$provaj = new stdClass();
$provaj ->name = $obj;
// $provaj ->age = 49;

$myjson = json_encode($provaj);

echo $myjson;

?>