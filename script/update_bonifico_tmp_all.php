<?php
    include "..\db.php";

    $istruzione = $_POST['chiave'];
    $azienda = $_POST['azienda'];

    if ($istruzione == 'ins_all'){
      $query = "DELETE FROM bonifici_tmp";
      $dati = mysqli_query($connessioneDB,$query);
      $query = "INSERT INTO bonifici_tmp (idPagamentiTemp, importoPagato) select idScadenzario, importoPagato from pagamenti_temp where idAzienda = '{$azienda}'";
      } else {
      $query = "DELETE FROM bonifici_tmp";
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

    // echo "$risp";

    $result = [];
    $result['importo'] = $risp;

  	echo json_encode($result);


?>