<?php

    include "..\db.php";

    $iditem = $_POST['idScadenzario'];
    $iban_mod = $_POST['iban_str'];
    $importo_mod = $_POST['importoPagamento'];
    $data_mod = $_POST['DataPagamento'];
    $mezzo_mod = $_POST['ModoPagamento'];
    $note_mod = $_POST['Note'];

    $query = "INSERT INTO fe2021.pagamenti_temp (
        idScadenzario, 
        idAzienda,
        denominazione,
        IdFE,
        forn_piva,
        forn_den,
        doc_tipo,
        doc_nr,
        doc_data,
        doc_importo,
        ModoPagamento,
        IBAN,
        scadenzaPagamento,
        importoPagamento) 
        select 
        scadenza.Id,
        scadenza.idAzienda,
        scadenza.denominazione,
        scadenza.IdFE,
        scadenza.forn_piva,
        scadenza.forn_den,
        scadenza.doc_tipo,
        scadenza.doc_nr,
        scadenza.doc_data,
        scadenza.doc_importo,
        scadenza.ModoPagamento,
        scadenza.IBAN,
        scadenza.scadenzaPagamento,
        scadenza.differenza
        from view_scadenzario_aperto as scadenza
        where scadenza.Id='$iditem'";

    $dati = mysqli_query($connessioneDB,$query);
    if (!$dati){
        //SETTAGGIO MESSAGGIO DI ERRORE
        echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    }

    $query_update = "UPDATE pagamenti_temp SET 
    IBAN = NULLIF('$iban_mod',''), DataPagamento = NULLIF('$data_mod',''), ImportoPagato = '$importo_mod', 
    Note = NULLIF('$note_mod',''), modPagamento = '$mezzo_mod' 
    WHERE idScadenzario ='$iditem'";

    $dati_update = mysqli_query($connessioneDB,$query_update);
    if (!$dati_update){
        //SETTAGGIO MESSAGGIO DI ERRORE
        echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    }
    
    /* close connection */
    $mysqli->close();

?>