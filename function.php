<?php
//FUNZIONE PER POPOLARE L'ARRAY CHE VERRA' UTILIZZATO PER LA CREAZIONE DEI FORM NEL FILE form.php
function dati_array($tabella_nodi, $radice){
    foreach ($tabella_nodi as $dati){
        $elemento = $dati[2];
        $verifica=$radice->xpath($elemento);
        if($verifica){
            $dato = (string) $verifica[0];
        } else {
            $dato="";
        }
        $dati_array[] = $dato;
    }
    return $dati_array;
}


//FUNZIONE CHE CARICA NEL SERVER IL FILE XML SELEZIONATO E RITORNA L'ARRAY IN FORMATO SIMPLEXML
function carica_xml(){

  
    
    // print_r($_FILES);
    // echo "<br>";
    
    $uploadDir = __DIR__.'/uploads';
    foreach ($_FILES as $file) {
        if (UPLOAD_ERR_OK === $file['error']) {
            $fileName = basename($file['name']);
            // echo "nome file ".$fileName."<br>";
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            // echo "estensione ".$ext."<br>";
            $fileout = pathinfo($fileName, PATHINFO_FILENAME);
            // echo "nome file senza estensione ".$fileout."<br>"; 
            move_uploaded_file($file['tmp_name'], $uploadDir.DIRECTORY_SEPARATOR.$fileName);
            
            //LA FUNZIONE strcasecmp PERMETTE DI FARE UNA VERIFICA DELLE STRINGHE CASE INSENSITIVE
            if (strcasecmp($ext, "p7m") == 0) {
                $file = "..\uploads\\".$fileName;
                $out = shell_exec('cd openssl & openssl smime -decrypt -in '.$file.' -inform DER -verify -noverify -out "..\uploads\\'.$fileout.'"');
                // $out = shell_exec('cd openssl & openssl smime -verify -inform DER -in '.$file.' -noverify -out "..\uploads\\'.$fileout.'"');
                $xml = simplexml_load_file($uploadDir.DIRECTORY_SEPARATOR.$fileout);
            } else {
                $xml = simplexml_load_file($uploadDir.DIRECTORY_SEPARATOR.$fileName);
            }
        }
    }

    return $xml;

    
}


//FUNZIONE PER ACQUISIRE L'ID UNIVOCO DA INSERIRE NEL DATABASE NEL FORMATO AAAAMMDDhhmmss
function crea_id(){
    $id_db = date("YmdHis");
    //RITORNO IL VALORE GENERATO
    return $id_db;
}

//visualizza le scadenze del documento
function mostra_dati_scadenze($tabella_nodi, $xml_file){
    $nr_scadenze = $xml_file->xpath("FatturaElettronicaBody/DatiPagamento");
    $scadenze_dati = array();
    $scadenze_array = array();
    $posizioine_array = 0;

    //istruzioni da eseguire se non è presente alcuna scadenza
    if (!$nr_scadenze){
        foreach ($tabella_nodi as $dati){
            $elemento = $dati[1].$dati[2];
            $verifica=$xml_file->xpath($elemento);
            if($verifica){
                foreach ($xml_file->xpath($elemento) as $informazioni) {
                    echo $dati[0].": ";
                    echo "<b>".$informazioni."</b>";
                    $dato = (string) $informazioni;
                    echo "<br/>";
                    $scadenze_array[$posizioine_array][] = $dato;
                }
            } else {
                echo $dati[0].":";
                $scadenze_array[$posizioine_array][] = "";
                echo "<br/>";
            }
        }
        $dato = "";
        echo "DettaglioPagamento/ModalitaPagamento: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";
        $dato = (string) $xml_file->FatturaElettronicaBody->DatiGenerali->DatiGeneraliDocumento->Data;
        echo "DettaglioPagamento/DataScadenzaPagamento: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";
        $dato = (string) $xml_file->FatturaElettronicaBody->DatiGenerali->DatiGeneraliDocumento->ImportoTotaleDocumento;
        echo "DettaglioPagamento/ImportoPagamento: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";
        $dato = "";
        echo "DettaglioPagamento/IBAN: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";       
    }

    //istruzioni da eseguire se nel file xml sono presenti delle scadenze
    foreach ($nr_scadenze as $scadenze){
        foreach ($tabella_nodi as $dati){
            $elemento = $dati[1].$dati[2];
            $verifica=$xml_file->xpath($elemento);
            if($verifica){
                foreach ($xml_file->xpath($elemento) as $informazioni) {
                    echo $dati[0].": ";
                    echo "<b>".$informazioni."</b>";
                    $dato = (string) $informazioni;
                    echo "<br/>";
                    $scadenze_array[$posizioine_array][] = $dato;
                }
            } else {
                echo $dati[0].":";
                $scadenze_array[$posizioine_array][] = "";
                echo "<br/>";
            }
        }
        $dato = (string) $scadenze->DettaglioPagamento->ModalitaPagamento;
        echo "DettaglioPagamento/ModalitaPagamento: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";
        $dato = (string) $scadenze->DettaglioPagamento->DataScadenzaPagamento;
        echo "DettaglioPagamento/DataScadenzaPagamento: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";
        $dato = (string) $scadenze->DettaglioPagamento->ImportoPagamento;
        echo "DettaglioPagamento/ImportoPagamento: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";
        $dato = (string) $scadenze->DettaglioPagamento->IBAN;
        echo "DettaglioPagamento/IBAN: "."<b>".$dato."</b>";
        $scadenze_array[$posizioine_array][] = $dato;
        echo "<br/>";
        $posizioine_array = $posizioine_array + 1;
    }

    echo "<br/>";
    return $scadenze_array;
    
}

// //funzione per scrivere i dati del file xml a video
// function mostra_dati($tabella_nodi, $xml_file){
//     foreach ($tabella_nodi as $dati){
//         $elemento = $dati[1].$dati[2];
//         $verifica=$xml_file->xpath($elemento);
//         if($verifica){
//             foreach ($xml_file->xpath($elemento) as $informazioni) {
//                 echo $dati[0].": ";
//                 echo "<b>".$informazioni."</b>";
//                 echo "<br/>";
//             }
//         } else {
//             echo $dati[0].":";
//             echo "<br/>";
//         }
//     }
// }

function mostra_tutto($xml_file){
    $array_xml=Array();
    $id1=0;
    $id2=0;
    $id3=0;
    $id4=0;
    $id5=0;
    $id6=0;
    foreach ($xml_file->children() as $item1){
        $id1=$id1+1;
        $id2=$id2+1;
        $id3=$id3+1;
        $id4=$id4+1;
        $id5=$id5+1;
        $id6=$id6+1;
        $nodo1=$item1->getname();
        $valore1=(string) $item1[0];
        $newdata=array($id1,$nodo1,$id2,"",$id3,"",$id4,"",$id5,"",$id6,"",$valore1);
        $array_xml[][]=$newdata;
        foreach ($item1->children() as $item2){
            $id2=$id2+1;
            $id3=$id3+1;
            $id4=$id4+1;
            $id5=$id5+1;
            $id6=$id6+1;
            $nodo2=$item2->getname();
            $valore2=(string) $item2[0];
            $newdata=Array($id1,$nodo1,$id2,$nodo2,$id3,"",$id4,"",$id5,"",$id6,"",$valore2);
            $array_xml[][]=$newdata;
            foreach ($item2->children() as $item3){
                $id3=$id3+1;
                $id4=$id4+1;
                $id5=$id5+1;
                $id6=$id6+1;
                $nodo3=$item3->getname();
                $valore3=(string) $item3[0];
                $newdata=Array($id1,$nodo1,$id2,$nodo2,$id3,$nodo3,$id4,"",$id5,"",$id6,"",$valore3);
                $array_xml[][]=$newdata;
                foreach ($item3->children() as $item4){
                    $id4=$id4+1;
                    $id5=$id5+1;
                    $id6=$id6+1;
                    $nodo4=$item4->getname();
                    $valore4=(string) $item4[0];
                    $newdata=Array($id1,$nodo1,$id2,$nodo2,$id3,$nodo3,$id4,$nodo4,$id5,"",$id6,"",$valore4);
                    $array_xml[][]=$newdata;
                    foreach ($item4->children() as $item5){
                        $id5=$id5+1;
                        $id6=$id6+1;
                        $nodo5=$item5->getname();
                        $valore5=(string) $item5[0];
                        $newdata=Array($id1,$nodo1,$id2,$nodo2,$id3,$nodo3,$id4,$nodo4,$id5,$nodo5,$id6,"",$valore5);
                        $array_xml[][]=$newdata;
                        foreach ($item5->children() as $item6){
                            $id6=$id6+1;
                            $nodo6=$item6->getname();
                            $valore6=(string) $item6[0];
                            $newdata=Array($id1,$nodo1,$id2,$nodo2,$id3,$nodo3,$id4,$nodo4,$id5,$nodo5,$id6,$nodo6,$valore6);
                            $array_xml[][]=$newdata;
                        }
                    }
                }
            }
        }
    }
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    // print_r ($array_xml);
    echo('<table>');
    foreach ($array_xml as $elemento){
        echo('<tr>');
        // print_r ($elemento);
        foreach ($elemento as $dato) {
            // print_r ($dato);
            echo "<td>".$dato[0]."</td>"."<td>".$dato[1]."</td>"."<td>".$dato[2]."</td>"."<td>".$dato[3]."</td>"."<td>".$dato[4]."</td>"."<td>".$dato[5]."</td>"."<td>".$dato[6]."</td>"."<td>".$dato[7]."</td>"
            ."<td>".$dato[8]."</td>"."<td>".$dato[9]."</td>"."<td>".$dato[10]."</td>"."<td>".$dato[11]."</td>"."<td>".$dato[12]."</td>";
        }
        echo("</tr>\n");
    }
    echo('</table>');

    return $array_xml;

}

//FUNZIONE PER VISUALIZZARE IN FORMATO TABELLA I DATI CONTENUTI NEL FILE SIMPLEXML.
//LA FUNZIONE LAVORA FINO A 6 LIVELLI DI NODI CHILDREN.
//NEL CASO FOSSERO UN NUMERO DIVERSO E' NECESSARIO MODIFICARE I CICLI FOREACH, I DATI INSERITI NELL'ARRAY E IL FORMATO DELLA TABELLA
function visualizza_dati_xml($xml_file){
    //INIZIALIZZO L'ARRAY CHE CONTERRA' I DATI. SI TRATTA DI UN ARRAY DI ARRAY
    $array_xml=Array();
    //CICLO 6 LIVELLI DEL FILE SIMPLEXML E PER OGNUNO RECUPERO:
    //- IL NOME DEL NODO;
    //- L'EVENTUALE VALORE AD ESSO ASSOCIATO.
    // I DATI COSI RECUPERATI VENGONO MEMORIZZATI NELL'ARRAY
    foreach ($xml_file->children() as $item1){
        $nodo1=$item1->getname();
        $valore1=(string) $item1[0];
        $newdata=array($nodo1,"","","","","",$valore1);
        $array_xml[][]=$newdata;
        foreach ($item1->children() as $item2){
            $nodo2=$item2->getname();
            $valore2=(string) $item2[0];
            $newdata=Array($nodo1,$nodo2,"","","","",$valore2);
            $array_xml[][]=$newdata;
            foreach ($item2->children() as $item3){
                $nodo3=$item3->getname();
                $valore3=(string) $item3[0];
                $newdata=Array($nodo1,$nodo2,$nodo3,"","","",$valore3);
                $array_xml[][]=$newdata;
                foreach ($item3->children() as $item4){
                    $nodo4=$item4->getname();
                    $valore4=(string) $item4[0];
                    $newdata=Array($nodo1,$nodo2,$nodo3,$nodo4,"","",$valore4);
                    $array_xml[][]=$newdata;
                    foreach ($item4->children() as $item5){
                        $nodo5=$item5->getname();
                        $valore5=(string) $item5[0];
                        $newdata=Array($nodo1,$nodo2,$nodo3,$nodo4,$nodo5,"",$valore5);
                        $array_xml[][]=$newdata;
                        foreach ($item5->children() as $item6){                            
                            $nodo6=$item6->getname();
                            $valore6=(string) $item6[0];
                            $newdata=Array($nodo1,$nodo2,$nodo3,$nodo4,$nodo5,$nodo6,$valore6);
                            $array_xml[][]=$newdata;
                        }
                    }
                }
            }
        }
    }
    echo "<br/>";
    //SCRIVO I DATI CONTENUTI NELL'ARRAY $array_xml POCO SOPRA POPOLATO IN UNA TABELLA
    //INIZIALIZZO LA TABELLA IN HTML
    echo "<div id='tbl_xml'>";
    echo "<table class='table table-striped'>";
    //SCORRO ALL'INTERNO DI OGNI ELEMENTO DELL'ARRAY ($elemento E' ANCH'ESSO UN ULTERIORE ARRAY) E PER OGNI ELEMENTO GENERO UNA RIGA HTML
    foreach ($array_xml as $elemento){
        //APRO LA RIGA DELLA TABELLA
        echo('<tr>');
        //SCORRO GLI ELEMENTI DELL'ARRAY $elemento E SCRIVO OGNI DATO IN ESSO CONTENUTI IN UNA CELLA
        foreach ($elemento as $dato) {
            echo "<td>".$dato[0]."</td>"."<td>".$dato[1]."</td>"."<td>".$dato[2]."</td>"."<td>".$dato[3]."</td>"."<td>".$dato[4]."</td>"."<td>".$dato[5]."</td>"."<td>".$dato[6]."</td>";
        }
        //CHIUDO LA RIGA DELLA TABELLA
        echo("</tr>\n");
    }
    //CHIUDO LA TABELLA
    echo('</table>');
    echo "</div>";
}
?>