<?php
    include "..\db.php";
    $testo = $_POST['testo'];
    
    switch ($testo){
        case "%":
            $denominazione="Tutte le aziende";
            break;
        case "1":
            $denominazione="SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE";
            break;
        case "101":
            $denominazione="CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL";
            break;
        case "102":
            $denominazione="FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO";
            break;
        case "103":
            $denominazione="SERENISSIMA AGRIDATA SRL";
            break;
        case "104":
            $denominazione="ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL";
            break;
    }

    $query = "SELECT Id, idAzienda, denominazione, forn_den, doc_tipo, doc_nr, doc_data, 
    doc_importo, scadenzaPagamento, importoPagamento FROM pagamenti 
    WHERE Pagato = 'NO' and idAzienda like ('{$testo}') ORDER BY scadenzaPagamento";
    $dati = mysqli_query($connessioneDB,$query);
     
    
    echo '<table class="table table-hover">';
    echo '<thead>';
    echo  '<tr>';
    echo    '<th>Id</th>';
    if ($testo=="%"){
        echo    '<th>Azienda</th>';
    }
    echo    '<th>Fornitore</th>';
    echo    '<th>Tipo doc</th>';
    echo    '<th>Nr doc</th>';
    echo    '<th>Data doc</th>';
    echo    '<th>Importo doc</th>';
    echo    '<th>Scadenza</th>';
    echo    '<th>Importo scadenza</th>';
    echo  '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if ($dati) {
        while ($row = mysqli_fetch_array($dati)) {
            $Id = $row['Id'];
            if ($testo=="%"){
                $denominazione = $row['denominazione'];
            }
            $forn_den = $row['forn_den'];
            $doc_tipo = $row['doc_tipo'];
            $doc_nr = $row['doc_nr'];
            $doc_data = $row['doc_data'];
            $doc_importo = $row['doc_importo'];
            $scadenzaPagamento = $row['scadenzaPagamento'];
            $importoPagamento = $row['importoPagamento'];
    
            echo "<tr>";
            echo   "<th>{$Id}</th>";
            if ($testo=="%"){
                echo   "<td>{$denominazione}</td>";
            }
            echo   "<td>{$forn_den}</td>";
            echo   "<td>{$doc_tipo}</td>";
            echo   "<td>{$doc_nr}</td>";
            echo   "<td>{$doc_data}</td>";
            echo   "<td>{$doc_importo}</td>";
            echo   "<td>{$scadenzaPagamento}</td>";
            echo   "<td>{$importoPagamento}</td>";
            echo "</tr>";
    
        }
    }
    

echo '</tbody>';
echo '</table>';

?>
 