<?php
    include "..\db.php";
    $testo = $_POST['testo'];
    
    switch ($testo){
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
    doc_importo, scadenzaPagamento, importoPagamento, importoPagato, differenza FROM view_scadenzario_aperto 
    WHERE idAzienda like ('{$testo}') ORDER BY scadenzaPagamento";
    $dati = mysqli_query($connessioneDB,$query);

    //rilevo gli id delle scadenze a cui è associata la preparazione di un bonifico
    $query = "SELECT idScadenzario FROM pagamenti_temp";
    $dati_bontmp = mysqli_query($connessioneDB,$query);
     
    
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
    echo    '<th>Importo pagato</th>';
    echo    '<th>Residuo da pagare</th>';
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
            $importoPagato = $row['importoPagato'];
            $importoResiduo = $row['differenza'];
    
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
            echo   "<td>{$importoPagato}</td>";
            echo   "<td>{$importoResiduo}</td>";
            echo "<td>";
                echo " <button type='button' id='btnPagamento".$Id."' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalModifica".$Id."' title='Inserisci pagamento'>";
				echo "<img src='bootstrap-icons/currency-euro.svg'";
				echo "</button>";
			echo "</td>";
            echo "<td>";
                echo " <button type='button' id='btnBonifico".$Id."' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalPredisponi".$Id."' title='Predisponi pagamento'>";
				echo "<img src='bootstrap-icons/send-fill.svg'";
				echo "</button>";
			echo "</td>";
           
            //Inizio MODAL	modalModifica	
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
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="update_pag('.$Id.')">Aggiorna pagamento</button>
                        </div>
                    </div>
                </div>
            </div>';
            //FINE MODAL modalModifica

            //Inizio MODAL	modalPredisponi	
            echo '
            <div class="modal fade" id="modalPredisponi'.$Id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModal2Label'.$Id.'"><strong>Inserisci pagamento<br>'.$Id.' - '.$forn_den.' - doc. nr. '.$doc_nr.' - data '.$doc_data.'</strong></h5>
                        </div>
                            <div class="modal-body">

                                <div class="form-group form-group-sm">
                                    <label>Importo pagamento</label>
                                    <input type="text" class="form-control" id="importoPre_mod'.$Id.'" value="'.$importoPagamento.'">
                                </div>

                                <div class="form-group form-group-sm">
                                    <label>Data pagamento:</label><br>
                                    <input type="date" class="form-control" id="dataPre_mod'.$Id.'">
                                </div>

                                <div class="form-group form-group-sm">
                                    <label>Mezzo di pagamento:</label><br>
                                    <select class="form-control" id="mezzoPre_mod'.$Id.'">
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
                                    <input class="form-control" type="text" id="notePre_mod'.$Id.'">
                                </div>

                            </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="insert_pag('.$Id.')">Predisponi pagamento</button>
                        </div>
                    </div>
                </div>
            </div>';
            //FINE MODAL modalPredisponi

            echo "</tr>";
    
        }
    }
    
    if ($dati_bontmp) {
        echo '<script>';
        while ($row = mysqli_fetch_array($dati_bontmp)) {
            $iditem = $row['idScadenzario'];
            echo '
            document.getElementById("btnBonifico'.$iditem.'").classList.remove("btn-primary") 
            document.getElementById("btnBonifico'.$iditem.'").classList.add("btn-success")
            document.getElementById("btnBonifico'.$iditem.'").classList.add("disabled")
            document.getElementById("btnPagamento'.$iditem.'").classList.remove("btn-primary") 
            document.getElementById("btnPagamento'.$iditem.'").classList.add("btn-success")
            document.getElementById("btnPagamento'.$iditem.'").classList.add("disabled")
            ';
        }
        echo '</script>';
    }

echo '</tbody>';
echo '</table>';

?>
 