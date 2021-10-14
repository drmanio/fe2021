<?php
//CONNESSIONE AL DATABASE
global $connessioneDB;

$connessioneDB = mysqli_connect("localhost", "manio", "drm.73Pk!" , "fe2021");
if(!$connessioneDB){
    $connessioneDB = mysqli_connect("localhost", "manio", '5+!"c+OHED' , "fe2021");
    if(!$connessioneDB) {
        die ("Impossibile connettersi al DB");
    }
}
    
?>