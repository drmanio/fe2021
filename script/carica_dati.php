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
            echo "<td>";
                echo " <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalModifica".$Id."' title='Inserisci pagamento'>";
				echo "<img src='bootstrap-icons/currency-euro.svg'";
				echo "</button>";
				echo " <button class='btn btn-info' onclick='vcard(".$Id.")' title='Crea bonifico'>";
				echo "<img src='bootstrap-icons/send-fill.svg'>";
				echo "</button>";
			echo "</td>";
           
            //MODAL		
            echo '
            <div class="modal fade" id="modalModifica'.$Id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel'.$Id.'"><strong>Inserisci pagamento<br>'.$Id.' - '.$forn_den.' - doc. nr. '.$doc_nr.' - data '.$doc_data.'</strong></h5>
                        </div>
                            <div class="modal-body">

                                <div class="form-group form-group-sm">
                                    <label>Importo pagamento</label>
                                    <input type="text" class="form-control" id="importo_mod'.$Id.'" value="'.$importoPagamento.'">
                                </div>

                                <div class="form-group form-group-sm">
                                    <label>Data pagamento:</label><br>
                                    <input type="date" class="form-control" id="data_mod'.$Id.'">
                                </div>

                                <div class="form-group form-group-sm">
                                    <label>Mezzo di pagamento:</label><br>
                                    <select class="form-control" id="mezzo_mod'.$Id.'">
                                        <option value="Bonifico">Bonifico</option>
                                        <option value="Rid">Rid</option>
                                        <option value="Riba">Riba</option>
                                        <option value="Assegno">Assegno</option>
                                        <option value="Carta">Carta</option>
                                        <option value="Bancomat">Bancomat</option>
                                        <option value="Cassa">Cassa</option>
                                        <option value="Addebito diretto in conto">Addebito diretto in conto</option>
                                        <option value="Altro">Altro</option>
                                    </select>
                                </div>

                                <div class="form-group form-group-sm"> 
                                    <label>Note pagamento:</label><br>
                                    <input class="form-control" type="text" id="note_mod'.$Id.'">
                                </div>

                            </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="update_pag('.$Id.')">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>';
            //MODAL
            echo "</tr>";
    
        }
    }
    
echo '</tbody>';
echo '</table>';

?>
 