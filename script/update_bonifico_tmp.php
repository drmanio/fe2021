<?php

    include "..\db.php";

    $istruzione = $_POST['chiave'];
    $iditem = $_POST['idbonifico'];
    $importo = $_POST['importo'];

    if ($istruzione == 'ins'){
      $query = "INSERT INTO bonifici_tmp (idPagamentiTemp, importoPagato) VALUES ('$iditem', '$importo')";
      } else {
      $query = "DELETE FROM bonifici_tmp WHERE idPagamentiTemp = '$iditem'";
    }

    $dati = mysqli_query($connessioneDB,$query);
    if (!$test){
        //SETTAGGIO MESSAGGIO DI ERRORE
        echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    }
    
    /* close connection */
    $mysqli->close();

?>