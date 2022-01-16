<?php

    include "..\db.php";

    $iditem = $_POST['idScadenzario'];

    $query = "DELETE FROM `pagamenti_temp` WHERE `idPagamentiTemp`='$iditem'";

    $dati = mysqli_query($connessioneDB,$query);
    if (!$dati){
        //SETTAGGIO MESSAGGIO DI ERRORE
        echo ("Messagio di errore: ". mysqli_error($connessioneDB));
    }

    /* close connection */
    $mysqli->close();

?>