<?php

    include "..\db.php";

    $iditem = $_POST['iditem'];

    $importo_mod = $_POST['importo_mod'];
    $data_mod = $_POST['data_mod'];
    $mezzo_mod = $_POST['mezzo_mod'];
    $note_mod = $_POST['note_mod'];

    $query_string = "INSERT INTO pagamenti_scadenze (idScadenzario, importoPagamento, 
    DataPagamento, ModoPagamento, Note) VALUES ('$iditem','$importo_mod', '$data_mod', 
    '$mezzo_mod','$note_mod')";

    $test = mysqli_query($connessioneDB, $istruzione_sql);
    if (!$test){
        //SETTAGGIO MESSAGGIO DI ERRORE
        echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    }
    
    /* close connection */
    $mysqli->close();

?>