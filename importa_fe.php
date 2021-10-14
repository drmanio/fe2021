<?php
    //INIZIALIZZO LA SESSIONE PER TRASFERIRE ALCUNI DATI CON I FORM
    session_start(); 
    // IMPORTO LE FUNZIONI CONTENUTE NEL FILE function.php
    include "function.php";
    // IMPORTO LE VARIABILI ARRAY CONTENENTI I NODI XML DA ELABORARE CHE SI TROVANO NEL FILE fe_nodi.php
    include "fe_nodi.php";
    // IMPORTO LE FUNZIONI CHE GENERANO I FORM DI MEMORIZZAZIONE CONTENUTI NEL FILE form.php
    include 'form.php';
    //IMPORTO LA CONNESSIONE AL DATABASE
    include "db.php";
?>

<!DOCTYPE html>
<html>
    <head>

        <!-- CSS -->
        <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
        <!-- JS -->
        <script src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
        <script src="jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#noxml").hide();
                $("#xml").hide();
                $("#tbl_xml").hide();
                $("#dati_generali").hide();

                $("#btn_noxml").click(function(){
                    $("#noxml").toggle();
                });
                $("#btn_xml").click(function(){
                    $("#xml").toggle();
                });
                $("#btn_table_xml").click(function(){
                    $("#tbl_xml").toggle();
                });
                $("#btn_dati_generali").click(function(){
                    $("#dati_generali").hide();
                    $("#btn_dati_generali").hide();
                });
                $("#btn_view_dati_generali").click(function(){
                    $("#dati_generali").toggle();
                });
            });
        </script>

    </head>
    <body>
        <img src="bootstrap-icons-1.5.0/bootstrap.svg" alt="Bootstrap" width="32" height="32">
        <button id="btn_noxml" type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off">Documento non xml</button>
        <div id="noxml" style='background-color: lightgray; border 2px solid #000000'>
        <!-- FORM PER INSERIRE UNA SCADENZA DI PAGAMENTO NON DA FATTURA ELETTRONICA -->
        <form action="save_scadenzeNoSdi.php" method="post" target="_blank">
            <h3>Inserisci il documento che non proviene dallo Sdi e che verrà caricato nel database:</h3>
            <select name="info1">
                <option value=101>CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL</option>
                <option value=102>FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO</option>
                <option value=103>SERENISSIMA AGRIDATA SRL</option>
                <option value=104>ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL</option>
                <option value=1>SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE</option>
            </select><br>
            <div style="float:left; margin:5px;">
                    <label>Partita Iva fornitore:</label><br>
                    <input type="text" name="info2"><br>
            </div>
            <div style="float:left; margin:5px;">
                    <label>Codice fiscale fornitore:</label><br>
                    <input type="text" name="info3"><br>
            </div>
            <div style="clear:both;"></div>
            <div>
                <label>Denominazione fornitore:</label><br>
                <input type="text" name="info4" size="100"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>TipoDocumento:</label><br>
                <select name="info5">
                    <option value="TD01">Fattura</option>
                    <option value="TD04">Nota di credito</option>
                    <option value="TD05">Nota di debito</option>
                    <option value="TD06">Parcella</option>
                    <option value="0000">Altro</option>
                </select><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Divisa:</label><br>
                <input type="text" name="info6"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Data:</label><br>
                <input type="date" name="info7"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Numero:</label><br>
                <input type="text" name="info8"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Importo totale del documento:</label><br>
                <input type="text" name="info9"><br>
            </div>
            <div style="clear:both;"></div>
            <label>Note:</label><br>
            <input type="text" name="info10" size="100"><br>
            <div style="float:left; margin:5px;">
                <label>Data scadenza di pagamento:</label><br>
                <input type="date" name="info11"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Importo pagamento:</label><br>
                <input type="text" name="info12"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>IBAN:</label><br>
                <input type="text" name="info13" size="30"><br>
            </div>
            <div style="clear:both;"></div>
            <div style="float:left; margin:5px;"> 
                <label>Pagato:</label><br>
                <select name="info14">
                    <option value="NO">NO</option>
                    <option value="SI">SI</option>
                </select><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Data pagamento:</label><br>
                <input type="date" name="info15"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Mezzo di pagamento:</label><br>
                <select name="info16">
                    <option value="Bonifico">Bonifico</option>
                    <option value="Rid">Rid</option>
                    <option value="Riba">Riba</option>
                    <option value="Assegno">Assegno</option>
                    <option value="Carta">Carta</option>
                    <option value="Bancomat">Bancomat</option>
                    <option value="Cassa">Cassa</option>
                    <option value="Addebito diretto in conto">Addebito diretto in conto</option>
                    <option value="Altro">Altro</option>
                </select><br>
            </div>
            <div style="clear:both;"></div> 
            <label>Note pagamento:</label><br>
            <input type="text" name="info17" size="100"><br>
            <div style="float:left; margin:5px;">
                <label>Protocollo:</label><br>
                <input type="text" name="info18" STYLE="background-color : #72A4D2;"><br>
            </div>
            <div style="float:left; margin:5px;">
                <label>Id barcode:</label><br>
                <input type="text" name="info19" STYLE="background-color : #72A4D2;"><br>
            </div>
            <div style="clear:both;"></div>
            <br>
            <input type="submit" value="Memorizza dati nel database" name="submit_db">
        </form>
        </div>

        <br><br>
        
        <button id="btn_xml" type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off">Documento xml</button>
        <div id="xml" style='background-color: lightblue; border 2px solid #000000'>
        <!--
            FORM INIZIALE PER SELEZIONARE IL FILE E CHIEDERNE LA VISUALIZZAZIONE 
            The enctype attribute specifies how the form-data should be encoded when submitting it to the server.
            Note: The enctype attribute can be used only if method="post".
            Attribute Values:
            - application/x-www-form-urlencoded ** Default. All characters are encoded before sent (spaces are converted to "+" symbols, and special characters are converted to ASCII HEX values)
            - multipart/form-data ** This value is necessary if the user will upload a file through the form
            - text/plain ** Sends data without any encoding at all. Not recommended
        -->
        <!-- <form action="importa_fe.php" method="post" enctype="multipart/form-data"> -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <h3> Seleziona il file xml proveniente dallo Sdi da caricare:</h3>
            <input type="file" name="file">
            <br><br>
            <input type="submit" value="visualizza dati" name="submit">
        </form>
        </div>

        <div>
            <br>
            <!-- CODICE PHP CHE SI ATTIVA QUANDO VIENE PREMUTO IL PULSANTE CON NAME submit IN AGGIUNTA ALLA ACTION RIPORTATA NEL FORM -->
            <?php
            //VERIFICO SE E' STATO PREMUTO IL PULSANTE CON NAME submit
            if (isset($_POST['submit'])){
                //ESEGUO LA FUNZIONE carica_xml() CHE ARCHIVIA IL FILE IN UNA CARTELLA DEL SERVER E RITORNA UN FILE IN FORMATO SIMPLEXML CHE ASSEGNO ALLA VARIABILE $xml_file                
                $xml_file = carica_xml();
                //LA VARIABILE SUPERGLOBALE $_FILES E' UN ARRAY ASSOCIATIVO (chiavi: file) DI ARRAY ASSOCIATIVO (chiavi: name, type, tmp_name, error, size).
                //PER RECUPERARE IL NOME DEVO RECUPERARE IL VALORE DI name DELLA CHIAVE file
                $fileName = basename($_FILES['file']['name']);
                $_SESSION['nomeFile'] = $fileName;
                // echo "Nome del file caricato: ".$fileName."<br/>";
                // echo "<br>";
                // VERIFICO SE IL FILE SIMPLEXML E' STATO ATTRIBUITO ALLA VARIABILE
                // if($xml_file){ 
                //     echo ("Tutto ok, file caricato");
                //     echo "<br/>";
                // }
                // VISUALIZZO I DATI DELLA FATTURA ELETTRONICA CONTENUTI NEL FILE SIMPLEXML ATTRAVERSO LA FUNZIONE visualizza_dati_xml PRESENTE NEL FILE function.php
                echo "<br><b>VISUALIZZA I DATI CONTENUTI NEL FILE XML </b><br>";
                echo "<button id='btn_table_xml' class='btn btn-primary' type='button'>Dati file xml</button>";
                // RICHIAMO LA FUNZIONE PER VISUALIZZARE I DATI IN FORMA DI TABELLA
                visualizza_dati_xml($xml_file);
                // $_SESSION['file'] = $xml_file;
                // RICHIAMO LA FUNZIONE crea_id() CONTENUTA NEL FILE function.php PER ASSEGNARE ALLA VARIABILE $id_db L'ID UNIVOCO DELLA FATTURA XML
                // CHE VERRA' MEMORIZZATO NEL DATABASE
                $id_db=crea_id();
                //*********************************
                // MEMORIZZO L'ID UNIVOCO CONTENUTO NELLA VARIABILE $id_db IN UNA VARIABILE SUPER GLOBALE DI SESSIONE id
                $_SESSION['id'] = $id_db;
                //*********************************
                // SCRIVO A VIDEO L'ID GENERATO
                //echo "ID univoco database: ".$id_db;
                //echo "<br/>";
                //RECUPERO I DATI GENERALI DELLA FATTURA E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $dati_generali CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                //RICHIAMO LA FUNZIONE form_dati_generali() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                form_dati_generali($dati_generali, $xml_file);
                // $_SESSION['scadenze'] = $scadenze_db;
                echo "<br/>";
                //RECUPERO I DATI SUI PAGAMENTI E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $scadenze CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                //RICHIAMO LA FUNZIONE form_scadenze() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                form_scadenze($scadenze, $xml_file);
                echo "<br/>";
                form_ritenute($ritenute, $xml_file);
                echo "<br/>";
                form_beniservizi($beniservizi, $ddt, $xml_file);         
            }

            ?>
            <br><br>
        </div>

    </body>
</html>