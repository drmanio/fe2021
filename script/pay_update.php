<?php

    include "..\db.php";

    $iditem = $_POST['idScadenzario'];

    $importo_mod = $_POST['importoPagamento'];
    $data_mod = $_POST['DataPagamento'];
    $mezzo_mod = $_POST['ModoPagamento'];
    $note_mod = $_POST['Note'];

    $query = "INSERT INTO pagamenti_scadenze (idScadenzario, importoPagamento, 
    DataPagamento, ModoPagamento, Note) VALUES ('$iditem','$importo_mod', NULLIF('$data_mod',''), 
    '$mezzo_mod',NULLIF('$note_mod',''))";

    $dati = mysqli_query($connessioneDB,$query);
    if (!$test){
        //SETTAGGIO MESSAGGIO DI ERRORE
        echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    }
    
    /* close connection */
    $mysqli->close();

?>