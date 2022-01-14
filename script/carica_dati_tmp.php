<?php

include "..".DIRECTORY_SEPARATOR."db.php";
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

$query = "SELECT idPagamentiTemp, idScadenzario, idAzienda, forn_den, doc_tipo, doc_nr, doc_data, 
importoPagamento, DataPagamento, IBAN, importoPagato, Note FROM pagamenti_temp 
WHERE idAzienda like ('{$testo}') ORDER BY forn_den, scadenzaPagamento";
$dati = mysqli_query($connessioneDB,$query);

?>

<a class="btn btn-success" href="script/export_excel.php?idaz=<?php echo $testo;?>">Esporta dati in excel</a>
<button class="btn btn-info" onclick="archivia_pag('<?php echo $testo ?>')">Archivia dati pagamenti</button>

<table class="table table-hover" style="margin-left:10px">
  <thead>
    <tr>
      <th>Id</th>
      <th>Fornitore</th>
      <th>Tipo doc</th>
      <th>Nr doc</th>
      <th>Data doc</th>
      <th>Importo scadenza</th>
      <th>IBAN</th>
      <th>Importo bonifico</th>
      <th>Note</th>
    </tr>
  </thead>
  <tbody>

<?php

if ($dati) {
  while ($row = mysqli_fetch_array($dati)) {
    $Id = $row['idPagamentiTemp'];
    $forn_den = $row['forn_den'];
    $doc_tipo = $row['doc_tipo'];
    $doc_nr = $row['doc_nr'];
    $doc_data = $row['doc_data'];
    $scadenza_importo = $row['importoPagamento'];
    $iban = $row['IBAN'];
    $importoPagato = $row['importoPagato'];
    $note = $row['Note'];
    
?>

    <tr>
      <th><?php echo $Id ?></th>
      <td><?php echo $forn_den ?></td>
      <td><?php echo $doc_tipo ?></td>
      <td><?php echo $doc_nr ?></td>
      <td><?php echo $doc_data ?></td>
      <td><?php echo $scadenza_importo ?></td>
      <td><?php echo $iban ?></td>
      <td><?php echo $importoPagato ?></td>
      <td><?php echo $note ?></td>  
      <td>
        <button type="button" id="btnModPag<?php echo $Id ?>" class="btn" data-bs-toggle="modal" data-bs-target="#modalModifica<?php echo $Id ?>" title="Modifica pagamento">
          <img src="bootstrap-icons/currency-euro.svg">
        </button>
      </td>
      <td>
        <button type="button" id="btnDelPag<?php echo $Id ?>" class="btn" data-bs-toggle="modal" data-bs-target="#modalElimina<?php echo $Id ?>" title="Elimina pagamento">
          <img src="bootstrap-icons/trash.svg">
        </button>
      </td>

<?php     
            //Inizio MODAL	modalModifica	
            // echo '
            // <div class="modal fade" id="modalModifica'.$Id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            //     <div class="modal-dialog">
            //         <div class="modal-content">
            //             <div class="modal-header">
            //                 <h5 class="modal-title" id="myModalLabel'.$Id.'"><strong>Inserisci pagamento<br>'.$Id.' - '.$forn_den.' - doc. nr. '.$doc_nr.' - data '.$doc_data.'</strong></h5>
            //             </div>
            //                 <div class="modal-body">

            //                     <div class="form-group form-group-sm">
            //                         <label>Importo pagamento</label>
            //                         <input type="text" class="form-control" id="importo_mod'.$Id.'" value="'.$importoPagamento.'">
            //                     </div>

            //                     <div class="form-group form-group-sm">
            //                         <label>Data pagamento:</label><br>
            //                         <input type="date" class="form-control" id="data_mod'.$Id.'">
            //                     </div>

            //                     <div class="form-group form-group-sm">
            //                         <label>Mezzo di pagamento:</label><br>
            //                         <select class="form-control" id="mezzo_mod'.$Id.'">
            //                             <option value="Bonifico">Bonifico</option>
            //                             <option value="Rid">Rid</option>
            //                             <option value="Riba">Riba</option>
            //                             <option value="Assegno">Assegno</option>
            //                             <option value="Carta">Carta</option>
            //                             <option value="Bancomat">Bancomat</option>
            //                             <option value="Cassa">Cassa</option>
            //                             <option value="Addebito diretto in conto">Addebito diretto in conto</option>
            //                             <option value="Altro">Altro</option>
            //                         </select>
            //                     </div>

            //                     <div class="form-group form-group-sm"> 
            //                         <label>Note pagamento:</label><br>
            //                         <input class="form-control" type="text" id="note_mod'.$Id.'">
            //                     </div>

            //                 </div>
            //             <div class="modal-footer">

            //                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            //                 <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="update_pag('.$Id.')">Aggiorna pagamento</button>
            //             </div>
            //         </div>
            //     </div>
            // </div>';
            // //FINE MODAL modalModifica

            // //Inizio MODAL	modalPredisponi	
            // echo '
            // <div class="modal fade" id="modalPredisponi'.$Id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            //     <div class="modal-dialog">
            //         <div class="modal-content">
            //             <div class="modal-header">
            //                 <h5 class="modal-title" id="myModal2Label'.$Id.'"><strong>Inserisci pagamento<br>'.$Id.' - '.$forn_den.' - doc. nr. '.$doc_nr.' - data '.$doc_data.'</strong></h5>
            //             </div>
            //                 <div class="modal-body">

            //                     <div class="form-group form-group-sm">
            //                         <label>Importo pagamento</label>
            //                         <input type="text" class="form-control" id="importoPre_mod'.$Id.'" value="'.$importoPagamento.'">
            //                     </div>

            //                     <div class="form-group form-group-sm">
            //                         <label>Data pagamento:</label><br>
            //                         <input type="date" class="form-control" id="dataPre_mod'.$Id.'">
            //                     </div>

            //                     <div class="form-group form-group-sm">
            //                         <label>Mezzo di pagamento:</label><br>
            //                         <select class="form-control" id="mezzoPre_mod'.$Id.'">
            //                             <option value="Bonifico">Bonifico</option>
            //                             <option value="Rid">Rid</option>
            //                             <option value="Riba">Riba</option>
            //                             <option value="Assegno">Assegno</option>
            //                             <option value="Carta">Carta</option>
            //                             <option value="Bancomat">Bancomat</option>
            //                             <option value="Cassa">Cassa</option>
            //                             <option value="Addebito diretto in conto">Addebito diretto in conto</option>
            //                             <option value="Altro">Altro</option>
            //                         </select>
            //                     </div>

            //                     <div class="form-group form-group-sm"> 
            //                         <label>Note pagamento:</label><br>
            //                         <input class="form-control" type="text" id="notePre_mod'.$Id.'">
            //                     </div>

            //                 </div>
            //             <div class="modal-footer">

            //                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            //                 <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="insert_pag('.$Id.')">Predisponi pagamento</button>
            //             </div>
            //         </div>
            //     </div>
            // </div>';
            //FINE MODAL modalPredisponi

            echo "</tr>";
    
        }
    }
    
    // if ($dati_bontmp) {
    //     echo '<script>';
    //     while ($row = mysqli_fetch_array($dati_bontmp)) {
    //         $iditem = $row['idScadenzario'];
    //         echo '
    //         document.getElementById("btnBonifico'.$iditem.'").classList.remove("btn-primary") 
    //         document.getElementById("btnBonifico'.$iditem.'").classList.add("btn-success")
    //         document.getElementById("btnBonifico'.$iditem.'").classList.add("disabled")
    //         document.getElementById("btnPagamento'.$iditem.'").classList.remove("btn-primary") 
    //         document.getElementById("btnPagamento'.$iditem.'").classList.add("btn-success")
    //         document.getElementById("btnPagamento'.$iditem.'").classList.add("disabled")
    //         ';
    //     }
    //     echo '</script>';
    // }

echo '</tbody>';
echo '</table>';

?>
 