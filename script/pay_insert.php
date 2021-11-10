<?php

    include "..\db.php";

    $iditem = $_POST['idScadenzario'];

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
        scadenza.importoPagamento
        from view_scadenzario_aperto as scadenza
        where scadenza.Id='$iditem'";

    $dati = mysqli_query($connessioneDB,$query);
    if (!$test){
        //SETTAGGIO MESSAGGIO DI ERRORE
        echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    }
    
    /* close connection */
    $mysqli->close();

?>