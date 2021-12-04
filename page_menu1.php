<html>
  <head>
    <!-- Elenco dei file che vengono inclusi nella pagina -->
    <?php
      include "header.html";
      include "form.php";
      include "fe_nodi.php";
      include "function.php";
      include "navbar.html";
      include "script".DIRECTORY_SEPARATOR."upload.php";
    ?>

    
    <script>
      $(document).ready(function(){
        // EVIDENZIO IL PULSANTE DELLA NAVBAR MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml"
          pulsanti();
          sc_menu1();
      });
    </script>

  </head>
  <body>

    <!--
    FORM INIZIALE PER SELEZIONARE IL FILE E CHIEDERNE LA VISUALIZZAZIONE 
    -->

    <!-- With PHP, it is easy to upload files to the server. -->
    <!-- However, with ease comes danger, so always be careful when allowing file uploads! -->
    <!-- First, ensure that PHP is configured to allow file uploads. -->
    <!-- In your "php.ini" file, search for the file_uploads directive, and set it to On: -->

    <!-- create an HTML form that allow users to choose the file they want to upload -->
    <!-- Some rules to follow for the HTML form: -->
    <!-- Make sure that the form uses method="post" -->
    <!-- The form also needs the following attribute: enctype="multipart/form-data". It specifies which content-type to use when submitting the form -->
    <!-- Without the requirements above, the file upload will not work. -->

    <!-- Other things to notice: -->

    <!-- The type="file" attribute of the <input> tag shows the input field as a file-select control, with a "Browse" button next to the input control -->
    <!-- The form sends data to a file called "upload.php" -->

    <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
    $ _SERVER [ 'PHP_SELF'] è comodo perché rende il codice di un form riutilizzabile, non dovrai infatti cambiare ogni volta l'argomento riferito all'ACTION. -->
    <form action = <?php echo $_SERVER['PHP_SELF']; ?> method="post" enctype="multipart/form-data">
      <h3> Seleziona il file xml/p7m proveniente dallo Sdi da caricare:</h3>
      <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
      <br>
      <input type="submit" id="btn_view_dati_xml" value="carica il file" name="submit" onclick="this.style.display='none'">
    </form>


    <div>
      <!-- CODICE PHP CHE SI ATTIVA QUANDO VIENE PREMUTO IL PULSANTE CON NAME submit IN AGGIUNTA ALLA ACTION RIPORTATA NEL FORM -->
      <?php
        //VERIFICO SE E' STATO PREMUTO IL PULSANTE CON NAME submit
        if (isset($_POST['submit'])){
          //ESEGUO LA FUNZIONE carica_xml() CHE ARCHIVIA IL FILE IN UNA CARTELLA DEL SERVER E RITORNA UN FILE IN FORMATO SIMPLEXML CHE ASSEGNO ALLA VARIABILE $xml_file. La funzione si trova nel file upload.php all'interno della cartella script                
          $xml_file = carica_xml();

          // Questa parte della pagina viene attivata se la variabile $xml_file non è vuota (quindi il caricamento del file xml è andato a buon fine)
          if ($xml_file){
            // RICHIAMO LA FUNZIONE crea_id() CONTENUTA NEL FILE function.php PER ASSEGNARE ALLA VARIABILE $id_db L'ID UNIVOCO DELLA FATTURA XML
            // CHE VERRA' MEMORIZZATO NEL DATABASE
            $id_db=crea_id();
            //*********************************
            // MEMORIZZO L'ID UNIVOCO CONTENUTO NELLA VARIABILE $id_db IN UNA VARIABILE SUPER GLOBALE DI SESSIONE id
            $_SESSION['id'] = $id_db;
            //*********************************
            ?>
            
            <!-- If you want to create a simple horizontal menu, add the .nav class to a <ul> element, followed by .nav-item for each <li> and add the .nav-link class to their links -->

            <!-- To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a <div> element with class .tab-content.

            If you want the tabs to fade in and out when clicking on them, add the .fade class to .tab-pane -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#datigen">Dati generali</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#scadenze">Scadenze</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#ritenute">Ritenute</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#beniservizi">Beni e servizi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#filexml">File xml</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane container active" id="datigen">
                <?php
                //RECUPERO I DATI GENERALI DELLA FATTURA E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $dati_generali CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                //RICHIAMO LA FUNZIONE form_dati_generali() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                form_dati_generali($dati_generali, $xml_file);
                ?>
              </div>
              <div class="tab-pane container fade" id="scadenze">
                <?php
                //RECUPERO I DATI SUI PAGAMENTI E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $scadenze CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                //RICHIAMO LA FUNZIONE form_scadenze() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                form_scadenze($scadenze, $xml_file);
                ?>
              </div>
              <div class="tab-pane container fade" id="ritenute">
                <?php  
                form_ritenute($ritenute, $xml_file);
                ?>
              </div>
              <div class="tab-pane container fade" id="beniservizi">
                <?php  
                form_beniservizi($beniservizi, $ddt, $xml_file);
                ?>
              </div>
              <div class="tab-pane container fade" id="filexml">
                <?php  
                visualizza_dati_xml($xml_file);
                ?>
              </div>
            </div>

            <?php
      //LA VARIABILE SUPERGLOBALE $_FILES E' UN ARRAY ASSOCIATIVO (chiavi: file) DI ARRAY ASSOCIATIVO (chiavi: name, type, tmp_name, error, size).
      //PER RECUPERARE IL NOME DEVO RECUPERARE IL VALORE DI name DELLA CHIAVE file
      // $fileName = basename($_FILES['fileToUpload']['name']);
      // echo $fileName;
      // echo "<br>";
      // $ext = pathinfo($fileName, PATHINFO_EXTENSION);
      // echo $ext;
      // echo "<br>";
      // $fileout = pathinfo($fileName, PATHINFO_FILENAME);
      // echo $fileout;
      // echo "<br>";
      // if ($ext=="p7m"){
          // $_SESSION['nomeFile'] = $fileout;
      // } else {
          // $_SESSION['nomeFile'] = $fileName;
      // }
      // echo "Nome del file caricato: ".$fileName."<br/>";
      // echo "<br>";
      // VERIFICO SE IL FILE SIMPLEXML E' STATO ATTRIBUITO ALLA VARIABILE
      // if($xml_file){ 
      //     echo ("Tutto ok, file caricato");
      //     echo "<br/>";
      // }
      // VISUALIZZO I DATI DELLA FATTURA ELETTRONICA CONTENUTI NEL FILE SIMPLEXML ATTRAVERSO LA FUNZIONE visualizza_dati_xml PRESENTE NEL FILE function.php
      // echo "<br><b>VISUALIZZA I DATI CONTENUTI NEL FILE XML </b>";
      // echo "<button id='btn_table_xml' class='btn btn-primary' type='button'>Dati file xml</button>";
      // RICHIAMO LA FUNZIONE PER VISUALIZZARE I DATI IN FORMA DI TABELLA
      // visualizza_dati_xml($xml_file);
      // $_SESSION['file'] = $xml_file;
      // RICHIAMO LA FUNZIONE crea_id() CONTENUTA NEL FILE function.php PER ASSEGNARE ALLA VARIABILE $id_db L'ID UNIVOCO DELLA FATTURA XML
      // CHE VERRA' MEMORIZZATO NEL DATABASE
      // $id_db=crea_id();
      //*********************************
      // MEMORIZZO L'ID UNIVOCO CONTENUTO NELLA VARIABILE $id_db IN UNA VARIABILE SUPER GLOBALE DI SESSIONE id
      // $_SESSION['id'] = $id_db;
      //*********************************
      // SCRIVO A VIDEO L'ID GENERATO
      //echo "ID univoco database: ".$id_db;
      //echo "<br/>";
      //RECUPERO I DATI GENERALI DELLA FATTURA E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
      //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $dati_generali CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
      //RICHIAMO LA FUNZIONE form_dati_generali() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
      // form_dati_generali($dati_generali, $xml_file);
      // $_SESSION['scadenze'] = $scadenze_db;
      // echo "<br/>";
      //RECUPERO I DATI SUI PAGAMENTI E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
      //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $scadenze CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
      //RICHIAMO LA FUNZIONE form_scadenze() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
      // form_scadenze($scadenze, $xml_file);
      // echo "<br/>";
      // form_ritenute($ritenute, $xml_file);
      // echo "<br/>";
      // form_beniservizi($beniservizi, $ddt, $xml_file);
          }
             
        }

?>
<br><br>
</div>
</body>
</html>
        