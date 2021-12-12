<?php
//FUNZIONE PER CREARE IL FORM NECESSARIO ALLA MEMORIZZAZIONE DEI DATI GENERALI DELLA FATTURA 
// la funzione ha bisogno di due variabili:
// l'array $tabella_nodi che contiene i riferimenti dei nodi del file xml necessari
// il tracciato xml da analizzare
function form_dati_generali($tabella_nodi, $xml_file){
  // per ogni nodo contenuto nell'array di riferimento
  foreach ($tabella_nodi as $dati){
    // recupero il nome completo del nodo
    $elemento = $dati[1].$dati[2];
    // assegno il valore recuperato alla variabile $verifica
    $verifica=$xml_file->xpath($elemento);
    // se la variabile non è vuota (il nodo xml contiene un valore)
    if($verifica){
      // per ogni valore contenuto nel singolo nodo
      foreach ($xml_file->xpath($elemento) as $informazioni) {
        // recupero il dato
        $dato = (string) $informazioni;
        // lo aggiungo ad un array di array contenente le informazioni
        $info_array[] = $dato;
      }
      // altrimenti
    } else {
        // memorizzo un valore vuoto
        $info_array[] = "";
    }
  }

  // Costruisco il form che contiene i dati generali
  ?>
  
  <form id="dati_generali" action="save_dati_generali.php" method="post" target="_blank">
    <label>Id database:</label><br>'
    <input type="text" readonly value="<?php $_SESSION['id'] ?>" name="info1" STYLE="background-color : lightgray;"><br>
    <label>Nome file xml:</label><br>
    <input type="text" readonly value="<?php $_SESSION['nomeFile'] ?>" name="info2" size="100" STYLE="background-color : lightgray;"><br>
    <label>Protocollo:</label><br>
    <input type="text" name="info3" STYLE="background-color : #72A4D2;"><br>
    <label>Id barcode:</label><br>
    <input type="text" name="info4" STYLE="background-color : #72A4D2;"><br>
    <label>Partita Iva azienda:</label><br>
    <input type="text" value="<?php $info_array[0] ?>" name="info5"><br>
    <label>Codice fiscale azienda:</label><br>
    <input type="text" value="<?php $info_array[1] ?>" name="info6"><br>
    <label>Denominazione azienda:</label><br>
    <input type="text" value="<?php $info_array[2] ?>" name="info7" size="100"><br>
    <label>Partita Iva fornitore:</label><br>
    <input type="text" value="<?php $info_array[3] ?>" name="info8"><br>
    <label>Codice fiscale fornitore:</label><br>
    <input type="text" value="<?php $info_array[4] ?>" name="info9"><br>
    <label>Denominazione fornitore:</label><br>
    <input type="text" value="<?php trim($info_array[5].$info_array[6].' '.$info_array[7]) ?>" name="info10" size="100"><br>
    <label>TipoDocumento:</label><br>
    <input type="text" value="<?php $info_array[8] ?>" name="info11"><br>
    <label>Divisa:</label><br>
    <input type="text" value="<?php $info_array[9] ?>" name="info12"><br>
    <label>Data:</label><br>
    <input type="date" value="<?php $info_array[10] ?>" name="info13"><br>
    <label>Numero:</label><br>
    <input type="text" value="<?php $info_array[11] ?>" name="info14"><br>
    <label>Importo totale del documento:</label><br>
    <?php
    if ($info_array[8]=="TD04") {
       $info_array[12]=abs($info_array[12])*(-1);
    }
    ?>
    <input type="text" value="<?php $info_array[12] ?>" name="info15"><br>
    <label>Note:</label><br>
    <input type="text" name="info16" size="100"><br>
    <input id="btn_dati_generali" type="submit" value="Memorizza nel db" name="submit_db" onclick="this.style.display='none'"><br>
  </form>
<?php
}
?>  