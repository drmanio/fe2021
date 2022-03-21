<?php
  include "..".DIRECTORY_SEPARATOR."db.php";
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

  // RECUPERO DAL DATABASE I DATI IN BASE ALL'AZIENDA SELEZIONATA
  $query = "SELECT 
    Id, idAzienda, denominazione, forn_den, doc_tipo, doc_nr, 
    doc_data, doc_importo, scadenzaPagamento, IBAN, importoPagamento, 
    importoPagato, differenza, Note 
    FROM 
    view_scadenzario_aperto 
    WHERE 
    idAzienda like ('{$testo}') 
    ORDER BY 
    scadenzaPagamento;";
  $dati = mysqli_query($connessioneDB,$query);

  // RILEVO GLI ID DELLE SCADENZE A CUI E' ASSOCIATO LA PREPARAZIONE DI UN BONIFICO
  $query_tmp = "SELECT 
    idScadenzario 
    FROM 
    pagamenti_temp 
    WHERE idAzienda like ('{$testo}');";
  $dati_bontmp = mysqli_query($connessioneDB,$query_tmp);
    
  ?>

  <div class="mytableFixHead">

  <table class="mytable">
    
    <thead class="mytable-dark">
      <tr>
        <th>Id</th>
        <?php if ($testo=="%"){ ?> <th>Azienda</th> <?php } ?>
        <th>Fornitore</th>
        <th>Tipo doc</th>
        <th>Nr doc</th>
        <th>Data doc</th>
        <th>Importo doc</th>
        <th>Scadenza</th>
        <th>Importo scadenza</th>
        <th>Importo pagato</th>
        <th>Residuo da pagare</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    
    <tbody>

  <?php

  if ($dati) {
    while ($row = mysqli_fetch_array($dati)) {
      $Id = $row['Id'];
      if ($testo=="%"){ $denominazione = $row['denominazione']; }
      $forn_den = $row['forn_den'];
      $doc_tipo = $row['doc_tipo'];
      $doc_nr = $row['doc_nr'];
      $doc_data = $row['doc_data'];
      $doc_importo = $row['doc_importo'];
      $scadenzaPagamento = $row['scadenzaPagamento'];
      $IBAN = $row['IBAN'];
      $importoPagamento = $row['importoPagamento'];
      $importoPagato = $row['importoPagato'];
      $importoResiduo = $row['differenza'];
      $note = $row['Note'];
      
      ?>

      <tr>
        <th> <?php echo $Id; ?> </th>
          <?php if ($testo=="%"){ ?> <td><?php echo $denominazione; ?></td> <?php } ?>
          <td><?php echo $forn_den; ?></td>
          <td><?php echo $doc_tipo; ?></td>
          <td><?php echo $doc_nr; ?></td>
          <td><?php echo $doc_data; ?></td>
          <td class="importo"><?php echo number_format($doc_importo, 2, ',', '.'); ?></td>
          <td><?php echo $scadenzaPagamento; ?></td>
          <td class="importo"><?php echo number_format($importoPagamento, 2, ',', '.'); ?></td>
          <td class="importo"><?php echo number_format($importoPagato, 2, ',', '.'); ?></td>
          <td class="importo"><?php echo number_format($importoResiduo, 2, ',', '.'); ?></td>
          <td>
            <button type="button" id="btnPagamento<?php echo $Id; ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalModifica<?php echo $Id; ?>" title="Inserisci pagamento">
              <img src="bootstrap-icons/currency-euro.svg"
            </button>
          </td>
          <td>
            <button type="button" id="btnBonifico<?php echo $Id; ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPredisponi<?php echo $Id; ?>" title="Predisponi pagamento">
              <img src="bootstrap-icons/send-fill.svg"
            </button>
          </td>
          
          <?php
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
                                  <input class="form-control" type="text" id="note_mod'.$Id.'" value="'.$note.'">
                              </div>

                          </div>
                      <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="update_pag('.$Id.','.$testo.')">Aggiorna pagamento</button>
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
                                  <input type="text" class="form-control" id="importoPre_mod'.$Id.'" value="'.$importoResiduo.'">
                              </div>

                              <div class="form-group form-group-sm">
                                  <label>Data pagamento:</label><br>
                                  <input type="date" class="form-control" id="dataPre_mod'.$Id.'">
                              </div>

                              <div class="form-group form-group-sm">
                                  <label>Iban destinatario:</label><br>
                                  <input class="form-control" type="text" id="ibanPre_mod'.$Id.'" value="'.$IBAN.'">
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
                                  <input class="form-control" type="text" id="notePre_mod'.$Id.'" value="'.$note.'">
                              </div>

                          </div>
                      <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="insert_pag('.$Id.','.$testo.')">Predisponi pagamento</button>
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

  </div>
  


 