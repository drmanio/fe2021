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

    $query = "SELECT sum(importoPagato) AS importo from fe2021.bonifici_tmp;";
    $dati = mysqli_query($connessioneDB,$query);

    // if (!$test){
    //     //SETTAGGIO MESSAGGIO DI ERRORE
    //     echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    // }
  
    while ($row = mysqli_fetch_array($dati)){
      $risp = $row['importo'];
    }

    // return $risp;

    // /* close connection */
    mysqli_close($connessioneDB);

    echo "$risp";

?>