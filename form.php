<?php
//FUNZIONE PER CREARE IL FORM NECESSARIO ALLA MEMORIZZAZIONE DEI DATI GENERALI DELLA FATTURA 
function form_dati_generali($tabella_nodi, $xml_file){
    foreach ($tabella_nodi as $dati){
        $elemento = $dati[1].$dati[2];
        $verifica=$xml_file->xpath($elemento);
        if($verifica){
            foreach ($xml_file->xpath($elemento) as $informazioni) {
                //echo $dati[0].": ";
                //echo "<b>".$informazioni."</b>";
                $dato = (string) $informazioni;
                //echo "<br/>";
                $info_array[] = $dato;
            }
        } else {
            //echo $dati[0].":";
            $info_array[] = "";
            //echo "<br/>";
        }
    }
    // echo "----------------------------------------------<br>";
    // echo "<b>MEMORIZZAZIONE DEI DATI GENERALI DEL DOCUMENTO </b>";
    // echo "<button id='btn_view_dati_generali' class='btn btn-primary' type='button'>Dati generali</button>";
    echo '<form id="dati_generali" action="save_dati_generali.php" method="post" target="_blank">';
    echo '<label>Id database:</label><br>';
    echo '<input type="text" readonly value="'.$_SESSION['id'].'" name="info1" STYLE="background-color : lightgray;"><br>';
    // echo '<label>Nome file xml:</label><br>';
    // echo '<input type="text" readonly value="'.$_SESSION['nomeFile'].'" name="info2" size="100" STYLE="background-color : lightgray;"><br>';
    echo '<label>Protocollo:</label><br>';
    echo '<input type="text" name="info3" STYLE="background-color : #72A4D2;"><br>';
    echo '<label>Id barcode:</label><br>';
    echo '<input type="text" name="info4" STYLE="background-color : #72A4D2;"><br>';
    echo '<label>Partita Iva azienda:</label><br>';
    echo '<input type="text" value="'.$info_array[0].'" name="info5"><br>';
    echo '<label>Codice fiscale azienda:</label><br>';
    echo '<input type="text" value="'.$info_array[1].'" name="info6"><br>';
    echo '<label>Denominazione azienda:</label><br>';
    echo '<input type="text" value="'.$info_array[2].'" name="info7" size="100"><br>';
    echo '<label>Partita Iva fornitore:</label><br>';
    echo '<input type="text" value="'.$info_array[3].'" name="info8"><br>';
    echo '<label>Codice fiscale fornitore:</label><br>';
    echo '<input type="text" value="'.$info_array[4].'" name="info9"><br>';
    echo '<label>Denominazione fornitore:</label><br>';
    echo '<input type="text" value="'.trim($info_array[5].$info_array[6]." ".$info_array[7]).'" name="info10" size="100"><br>';
    echo '<label>TipoDocumento:</label><br>';
    echo '<input type="text" value="'.$info_array[8].'" name="info11"><br>';
    echo '<label>Divisa:</label><br>';
    echo '<input type="text" value="'.$info_array[9].'" name="info12"><br>';
    echo '<label>Data:</label><br>';
    echo '<input type="date" value="'.$info_array[10].'" name="info13"><br>';
    echo '<label>Numero:</label><br>';
    echo '<input type="text" value="'.$info_array[11].'" name="info14"><br>';
    echo '<label>Importo totale del documento:</label><br>';
    if ($info_array[8]=="TD04") {
        $info_array[12]=abs($info_array[12])*(-1);
    }
    echo '<input type="text" value="'.$info_array[12].'" name="info15"><br>';
    echo '<label>Note:</label><br>';
    echo '<input type="text" name="info16" size="100"><br>';
    echo '<input id="btn_dati_generali" type="submit" value="Memorizza nel db" name="submit_db" onclick="this.style.display=\'none\'"><br>';
    echo '</form>';
}

//FUNZIONE PER CREARE IL FORM NECESSARIO ALLA MEMORIZZAZIONE DELLE SCADENZE DEL DOCUEMENTO
function form_scadenze ($tabella_nodi, $xml_file){
    //INIZIALIZZO LE VARIABILI CHE UTILIZZERO' PER CREARE IL FORM
    //- $nr_scadenze CONTIENE L'ARRAY DEL FILE SIMPLEXML NELLA PARTE RELATIVA AI DATI DI PAGAMENTO
    //- $scadenze_array INIZIALIZZA UN ARRAY DI ARRAY CHE CONTERRA' I DATI DA INSERIRE NEL FORM
    //- $posizione_array INIZIALIZZA IL PRIMO VALORE CHE VERRA' ATTRIBUITO ALL'ARRAY DELL'ARRAY $scadenze_array IN MODO DA GESTIRE PIU' SCADENZE
    $nr_scadenze = $xml_file->xpath("FatturaElettronicaBody/DatiPagamento");
    $scadenze_array = array();
    $posizione_array = 0;
    echo "<br/>";
//ISTRUZIONI DA ESEGUIRE NEL CASO NON SIA PRESENTE ALCUNA SCADENZA NEL FILE XML
    if (!$nr_scadenze){
        $data = (string) $xml_file->xpath("FatturaElettronicaBody/DatiGenerali/DatiGeneraliDocumento/Data")[0];
        $importo = (string) $xml_file->xpath("FatturaElettronicaBody/DatiGenerali/DatiGeneraliDocumento/ImportoTotaleDocumento")[0];
        $scadenze_array[$posizione_array] = array("",$data, $importo,"");
    } else {
        //ISTRUZIONI DA ESEGUIRE NEL CASO SIANO PRESENTI DELLE SCADENZE NEL FILE XML
        foreach ($nr_scadenze as $scadenze){
            $scadenze_array[]=dati_array($tabella_nodi, $scadenze);
        //     foreach ($tabella_nodi as $dati){
        //         $elemento = "DettaglioPagamento//".$dati[2];
        //         $verifica=$scadenze->xpath($elemento);
        //         if($verifica){
        //             $dato = (string) $verifica[0];
        //         } else {
        //             $dato="";
        //         }
        //         $scadenze_array[$posizione_array][] = $dato;
        //    }
           $posizione_array=$posizione_array+1;
        }
    }
    //************************************
    //print_r ($scadenze_array);
    //************************************

    //ESEGUO LA CREAZIONE DEL FORM PER OGNI SCADENZA PRESENTE NELLA VARIABILE $scadenze_array
    // echo "----------------------------------------------<br>";
    // echo "<b>MEMORIZZAZIONE DELLE SCADENZE DI PAGAMENTO </b>";
    $nr=1;
    // echo "<button id='btn_view_scadenze' class='btn btn-primary' type='button'>Dati scadenze</button><br>";
    foreach ($scadenze_array as $info_scadenze){
        echo '<form class="scadenze" action="save_scadenze.php" method="post" target="_blank">';
        echo "---SCADENZA NUMERO $nr---";
        echo '<br>';
        echo '<label>Id database:</label><br>';
        echo '<input type="text" value="'.$_SESSION['id'].'" name="info1" STYLE="background-color : lightgray;"><br>';
        echo '<label>Modalità di pagamento:</label><br>';
        echo '<input type="text" value="'.$info_scadenze[0].'" name="info2"><br>';
        echo '<label>Data scadenza di pagamento:</label><br>';
        echo '<input type="date" value="'.$info_scadenze[1].'" name="info3"><br>';
        echo '<label>Importo pagamento:</label><br>';
        echo '<input type="text" value="'.$info_scadenze[2].'" name="info4"><br>';
        echo '<label>IBAN:</label><br>';
        echo '<input type="text" value="'.$info_scadenze[3].'" name="info5" size="30"><br>';
        echo '<label>Pagato:</label><br>';
        echo '<select name="info6">
        <option value="NO">NO</option>
        <option value="SI">SI</option>
        </select><br>';
        echo '<label>Data pagamento:</label><br>';
        echo '<input type="date" name="info7"><br>';
        echo '<label>Mezzo di pagamento:</label><br>';
        echo '<select name="info8">
        <option value="Bonifico">Bonifico</option>
        <option value="Rid">Rid</option>
        <option value="Riba">Riba</option>
        <option value="Assegno">Assegno</option>
        <option value="Carta">Carta</option>
        <option value="Bancomat">Bancomat</option>
        <option value="Cassa">Cassa</option>
        <option value="Addebito diretto in conto">Addebito diretto in conto</option>
        <option value="Altro">Altro</option>
        </select><br>';
        echo '<label>Note:</label><br>';
        echo '<input type="text" name="info9" size="100"><br>';
        echo '<input type="submit" value="Memorizza scadenza nel db" name="submit_db" onclick="this.style.display=\'none\'"><br>';
        echo '</form>';
        $nr=$nr+1;
    }
}

//FUNZIONE PER CREARE IL FORM NECESSARIO ALLA MEMORIZZAZIONE DELLE RITENUTE DEL DOCUEMENTO
function form_ritenute ($tabella_nodi, $xml_file){
        // echo "----------------------------------------------<br>";
        // echo "<b>MEMORIZZAZIONE DELLE RITENUTA DA VERSARE </b>";
    //INIZIALIZZO LE VARIABILI CHE UTILIZZERO' PER CREARE IL FORM
    //- $nr_ritenute CONTIENE L'ARRAY DEL FILE SIMPLEXML NELLA PARTE RELATIVA AI DATI DI PAGAMENTO
    //- $ritenute_array INIZIALIZZA UN ARRAY DI ARRAY CHE CONTERRA' I DATI DA INSERIRE NEL FORM
    //- $posizione_array INIZIALIZZA IL PRIMO VALORE CHE VERRA' ATTRIBUITO ALL'ARRAY DELL'ARRAY $scadenze_array IN MODO DA GESTIRE PIU' SCADENZE
    $nr_ritenute = $xml_file->xpath("FatturaElettronicaBody/DatiGenerali/DatiGeneraliDocumento/DatiRitenuta");
    $ritenute_array = array();
    $posizione_array = 0;
//ISTRUZIONI DA ESEGUIRE NEL CASO SIANO PRESENTI DELLE RITENUTE NEL FILE XML
    if ($nr_ritenute){
        foreach ($nr_ritenute as $ritenute){
            foreach ($tabella_nodi as $dati){
                $elemento = $dati[2];
                $verifica=$ritenute->xpath($elemento);
                if($verifica){
                    $dato = (string) $verifica[0];
                } else {
                    $dato="";
                }
                $ritenute_array[$posizione_array][] = $dato;
           }
        $posizione_array=$posizione_array+1;
        }
    }
    //************************************
    //print_r ($scadenze_array);
    //************************************

    //ESEGUO LA CREAZIONE DEL FORM PER OGNI SCADENZA PRESENTE NELLA VARIABILE $ritenute_array
    // echo "<button id='btn_view_ritenute' class='btn btn-primary' type='button'>Dati ritenute</button><br>";
    $nr=1;
    foreach ($ritenute_array as $info){
        echo '<form class="ritenute" id="ritenute" action="save_ritenute.php" method="post" target="_blank">';
        echo "---RITENUTA NUMERO $nr---";
        echo '<br>';
        echo '<label>Id database:</label><br>';
        echo '<input type="text" value="'.$_SESSION['id'].'" name="info1" STYLE="background-color : lightgray;"><br>';
        echo '<label>Tipo ritenuta:</label><br>';
        echo '<input type="text" value="'.$info[0].'" name="info2"><br>';
        echo '<label>Importo ritenuta:</label><br>';
        echo '<input type="text" value="'.$info[1].'" name="info3"><br>';
        echo '<label>Aliquota ritenuta:</label><br>';
        echo '<input type="text" value="'.$info[2].'" name="info4"><br>';
        echo '<label>Causale pagamento:</label><br>';
        echo '<input type="text" value="'.$info[3].'" name="info5"><br>';
        echo '<label>Imponibile ritenuta (da verificare):</label><br>';
        echo '<input type="text" value="'.((double) $info[1]*5).'" name="info6"><br>';
        echo '<label>Data scademza ritenuta:</label><br>';
        echo '<input type="date" name="info7"><br>';
        echo '<label>Ritenuta pagata:</label><br>';
        echo '<select name="info8">
        <option value="NO">NO</option>
        <option value="SI">SI</option>
        </select><br>';
        echo '<label>Data pagamento ritenuta:</label><br>';
        echo '<input type="date" name="info9"><br>';
        echo '<label>Note:</label><br>';
        echo '<input type="text" name="info10" size="100"><br>';
        echo '<input type="submit" value="Memorizza ritenuta nel db" name="submit_db" onclick="this.style.display=\'none\'"><br>';
        echo '</form>';
        $nr=$nr+1;
    }
}

//FUNZIONE PER CREARE IL FORM NECESSARIO ALLA MEMORIZZAZIONE DEI BENI E SERVIZI
function form_beniservizi ($tabella_nodi, $tabella_nodi2, $xml_file){
    //INIZIALIZZO LE VARIABILI CHE UTILIZZERO' PER CREARE IL FORM
    //- $nr_servizi CONTIENE L'ARRAY DEL FILE SIMPLEXML NELLA PARTE RELATIVA AI BENI E SERVIZI
    //- $beniservizi_array INIZIALIZZA UN ARRAY DI ARRAY CHE CONTERRA' I DATI DA INSERIRE NEL FORM
    //- $posizione_array INIZIALIZZA IL PRIMO VALORE CHE VERRA' ATTRIBUITO ALL'ARRAY DELL'ARRAY $scadenze_array IN MODO DA GESTIRE PIU' SCADENZE
    $nr_beniservizi = $xml_file->xpath("FatturaElettronicaBody/DatiBeniServizi/DettaglioLinee");
    
    $beniservizi_array = array();
    $posizione_array = 0;
    $nr_ddt = $xml_file->xpath("FatturaElettronicaBody/DatiGenerali/DatiDDT");
    $ddt_array = array();
    $posizione_ddt_array = 0;
    if (!$nr_ddt){
        $ddt_array[$posizione_ddt_array] = array("","","");
    } else {
        foreach($nr_ddt as $ddt){
            //PER VERIFICARE SE ESISTONO PIU' RIFERIMENTI DI LINEA CON LO STESSO DDT
            //ESTRAGGO IL FILE SIMPLEXML A LIVELLO DI NUMERO DI LINEA
            $nr_linee_ddt = $ddt->xpath("RiferimentoNumeroLinea");
            //VERIFICO SE SONO PRESENTI PIU' RIFERIMENTI LINEA PER LO STESSO DDT; IN QUESTO CASO DOVRO'
            //CREARE TANTI DATI DELLO STESSO DDT QUANTI SONO I RIFERIMENTI DI LINEA
            if (count($nr_linee_ddt)>1) {
                foreach ($nr_linee_ddt as $nr_linea) {
                    $ddt_array[$posizione_ddt_array] = dati_array($tabella_nodi2, $ddt);
                    $ddt_array[$posizione_ddt_array][2]=(string) $nr_linea[0];
                    $posizione_ddt_array=$posizione_ddt_array+1;
                }
            } else {
                $ddt_array[$posizione_ddt_array] = dati_array($tabella_nodi2, $ddt);
                $posizione_ddt_array=$posizione_ddt_array+1;
            }
        }
    }

//ISTRUZIONI DA ESEGUIRE NEL CASO SIANO PRESENTI DELLE RITENUTE NEL FILE XML

    // echo "----------------------------------------------<br>";
    // echo "<b>MEMORIZZAZIONE DEI BENI E SERVIZI </b>";
    foreach ($nr_beniservizi as $beniservizi){
        $beniservizi_array[]=dati_array($tabella_nodi, $beniservizi);
    //     foreach ($tabella_nodi as $dati){
    //         $elemento = $dati[2];
    //         $verifica=$beniservizi->xpath($elemento);
    //         if($verifica){
    //             $dato = (string) $verifica[0];
    //         } else {
    //             $dato="";
    //         }
    //         $beniservizi_array[$posizione_array][] = $dato;
    //     }
    // $posizione_array=$posizione_array+1;
    }

    //************************************
    //print_r ($scadenze_array);
    //************************************

    //ESEGUO LA CREAZIONE DEL FORM PER OGNI SCADENZA PRESENTE NELLA VARIABILE $ritenute_array
    // echo "<button id='btn_view_beniservizi' class='btn btn-primary' type='button'>Dati beni e servizi</button><br>";
    $nr=1;
    foreach ($beniservizi_array as $info){
        echo '<form class="beniservizi" action="save_beniservizi.php" method="post" target="_blank">';
        echo "---BENE/SERVIZIO NUMERO $nr---";
        echo '<br>';
        echo '<label>Id database:</label><br>';
        echo '<input type="text" value="'.$_SESSION['id'].'" name="info1" STYLE="background-color : lightgray;"><br>';
        echo '<label>Numero linea:</label><br>';
        echo '<input type="text" value="'.$info[0].'" name="info2"><br>';
        echo '<label>Descrizione:</label><br>';
        echo '<input type="text" value="'.$info[1].'" name="info3" size="100"><br>';
        echo '<label>Quantita\':</label><br>';
        echo '<input type="text" value="'.$info[2].'" name="info4"><br>';
        echo '<label>Unita\' di misura:</label><br>';
        echo '<input type="text" value="'.$info[3].'" name="info5"><br>';
        echo '<label>Prezzo unitario:</label><br>';
        echo '<input type="text" value="'.$info[4].'" name="info6"><br>';
        echo '<label>Prezzo totale:</label><br>';
        echo '<input type="text" value="'.$info[5].'" name="info7"><br>';
        $check_ddt = 0;
        foreach ($ddt_array as $info_ddt){
            if ($info_ddt[2]=="" or $info_ddt[2]=="0" or $info_ddt[2]==$info[0]){
                echo '<label>Numero Ddt:</label><br>';
                echo '<input type="text" value="'.$info_ddt[0].'" name="info8" size="50"><br>';
                echo '<label>Data Ddt:</label><br>';
                echo '<input type="date" value="'.$info_ddt[1].'"name="info9"><br>';
                $check_ddt=1;
            } 
        }
        if ($check_ddt == 0){
            echo '<label>Numero Ddt:</label><br>';
            echo '<input type="text" name="info8"><br>';
            echo '<label>Data Ddt:</label><br>';
            echo '<input type="date" "name="info9"><br>';
        }
        echo '<label>Note:</label><br>';
        echo '<input type="text" name="info10" size="100"><br>';
        echo '<input type="submit" value="Memorizza bene/servizio nel db" name="submit_db" onclick="this.style.display=\'none\'"><br>';
        echo '</form>';
        echo '<br>';
        $nr=$nr+1;
    }
}
?>