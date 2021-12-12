<?php
// session_start();
?>

<html>
  <head>
    <!-- Elenco dei file che vengono inclusi nella pagina -->
    <?php
    // inserisco i riferimenti ai file necessari
    // riferimento alle informazioni da inserire nella parte head del file html
    include "header.html";
    // *****
    // riferimento al file che crea le form all'interno della pagina
    include "form.php";
    // *****
    // riferimento al file che contiene i nodi del file xml da leggere
    include "fe_nodi.php";
    // *****
    // riferimento al file che contiene le funzioni utilizzate nella pagina
    include "function.php";
    // riferimento al file che contiene la navbar superiore
    include "navbar.html";
    // riferimento al file che esegue l'upload del file xml/p7m
    include "script".DIRECTORY_SEPARATOR."upload.php";
    ?>
    
    <!-- script che vengono caricati all'apertura della pagina -->
    <script>
      $(document).ready(function(){
        // script che vengono attivati alla pressione dei pulsanti della navbar
        pulsanti();
        // script attivati dal caricamento della scelta del menu1
        sc_menu1();
      });
    </script>

  </head>
  <body>

    <!-- creo la barra di navigazione laterale -->
    <!-- la barra laterale viene formatata con il file sidebar.css -->
    <div class="sidenav" id="div_sidenav">
      <!-- Navigation available in Bootstrap share general markup and styles, from the base .nav class to the active and disabled states. 
      Swap modifier classes to switch between each style.
      The base .nav component is built with flexbox and provide a strong foundation for building all types of navigation components. 
      It includes some style overrides (for working with lists), some link padding for larger hit areas, and basic disabled styling. -->
      <!-- Takes the basic nav from above and adds the .nav-pills class to generate a pilled interface. -->
      <div class="nav nav-pills">
        <button class="nav-link active" id="v-pills-upload-tab" data-bs-toggle="pill" data-bs-target="#upload">Upload file</button>
        <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#datigen">Dati generali</button>
        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#scadenze">Scadenze</button>
        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#ritenute">Ritenute</button>
        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#beniservizi">Beni e servizi</button>
        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#filexml">File xml</button>
      </div>
    </div>
      
    <!-- div che contiene gli elementi principali della pagina.
    Il margine sinistro viene impostato a 165px se è presente la sidebar.
    Se non è presente o se viene nascosta (attraverso lo script) il margine sinistro viene impostato a 10px -->
    <div class="tab-content" id="v-pills-tabContent" style="margin-left:165px">
      <!-- div che viene visualizzato premendo il relativo pulsante upload sulla sidebar -->
      <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="v-pills-home-tab">
        
        <!-- FORM INIZIALE PER SELEZIONARE IL FILE E CHIEDERNE LA VISUALIZZAZIONE -->

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

        <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione
        lo script PHP rispetto alla root del Web server.
        $ _SERVER [ 'PHP_SELF'] è comodo perché rende il codice di un form riutilizzabile, non dovrai infatti cambiare ogni volta l'argomento riferito 
        all'ACTION. -->
        <form action = <?php echo $_SERVER['PHP_SELF']; ?> method="post" enctype="multipart/form-data">
          <h3> Seleziona il file xml/p7m proveniente dallo Sdi da caricare:</h3>
          <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
          <br>
          <input type="submit" id="btn_view_dati_xml" value="carica il file" name="submit" onclick="this.style.display='none'">
        </form>
      </div>

      <!-- CODICE PHP CHE SI ATTIVA QUANDO VIENE PREMUTO IL PULSANTE CON NAME submit IN AGGIUNTA ALLA ACTION RIPORTATA NEL FORM -->
      <?php

      // intercetto la pressione del pulsante con name submit
      if (isset($_POST['submit'])){
        // richiamo la funzione carica_xml contenuta nel file upload.php e assegno il tracciato xml ritornato dalla funzione alla variabile $xml
        $xml_file = carica_xml();
        // verifico se la variabile $xml non è vuota (contiene il tracciato xml). Se non è vuota procedo con le istruzioni successive
        if ($xml_file) {
          // recupero l'id_db univoco da utilizzare per memorizzare i dati nel database
          $id_db=crea_id();
          // memorizzo il valore nella variabile di sessione id
          $_SESSION['id'] = $id_db;
      ?>
          <!-- div che viene visualizzato premendo il relativo pulsante upload sulla sidebar -->
          <div class="tab-pane fade show" id="datigen" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <?php
              //RECUPERO I DATI GENERALI DELLA FATTURA E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
              //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $dati_generali CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
              //RICHIAMO LA FUNZIONE form_dati_generali() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
              form_dati_generali($dati_generali, $xml_file);
            ?>
          </div>


          <div class="tab-pane fade" id="scadenze" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <?php
              //RECUPERO I DATI SUI PAGAMENTI E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
              //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $scadenze CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
              //RICHIAMO LA FUNZIONE form_scadenze() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
              form_scadenze($scadenze, $xml_file);
            ?>
          </div>
          <div class="tab-pane fade" id="ritenute" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            <?php  
              form_ritenute($ritenute, $xml_file);
            ?>
          </div>
          <div class="tab-pane fade" id="beniservizi" role="tabpanel" aria-labelledby="v-pills-settings-tab">
            <?php  
              form_beniservizi($beniservizi, $ddt, $xml_file);
            ?>
          </div>
          <div class="tab-pane fade" id="filexml" role="tabpanel" aria-labelledby="v-pills-settings-tab">
            <?php  
              visualizza_dati_xml($xml_file);
            ?>
          </div>
      <?php
        }
      }
      ?>
      </div>

      <?php

        //VERIFICO SE E' STATO PREMUTO IL PULSANTE CON NAME submit


            // LA VARIABILE SUPERGLOBALE $_FILES E' UN ARRAY ASSOCIATIVO (chiavi: file) DI ARRAY ASSOCIATIVO (chiavi: name, type, tmp_name, error, size).
            // PER RECUPERARE IL NOME DEVO RECUPERARE IL VALORE DI name DELLA CHIAVE file
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
            //     $_SESSION['nomeFile'] = $fileout;
            // } else {
            //     $_SESSION['nomeFile'] = $fileName;
            // }

            // RICHIAMO LA FUNZIONE crea_id() CONTENUTA NEL FILE function.php PER ASSEGNARE ALLA VARIABILE $id_db L'ID UNIVOCO DELLA FATTURA XML
            // CHE VERRA' MEMORIZZATO NEL DATABASE
            // $id_db=crea_id();
            //*********************************
            // MEMORIZZO L'ID UNIVOCO CONTENUTO NELLA VARIABILE $id_db IN UNA VARIABILE SUPER GLOBALE DI SESSIONE id
            // $_SESSION['id'] = $id_db;
            //*********************************
      ?>

            <!-- <div class="d-flex align-items-start">
              <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#datigen" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Dati generali</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#scadenze" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Scadenze</button>
                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#ritenute" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Ritenute</button>
                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#beniservizi" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Beni e servizi</button>
                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#filexml" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">File xml</button>
              </div> -->
              <!-- <div class="tab-content" id="v-pills-tabContent"> -->
                <!-- <div class="tab-pane fade show active" id="datigen" role="tabpanel" aria-labelledby="v-pills-home-tab"> -->
                  <?php
                  //RECUPERO I DATI GENERALI DELLA FATTURA E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                  //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $dati_generali CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                  //RICHIAMO LA FUNZIONE form_dati_generali() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                  // form_dati_generali($dati_generali, $xml_file);
                  ?>
                <!-- </div> -->
                <!-- <div class="tab-pane fade" id="scadenze" role="tabpanel" aria-labelledby="v-pills-profile-tab"> -->
                  <?php
                  //RECUPERO I DATI SUI PAGAMENTI E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                  //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $scadenze CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                  //RICHIAMO LA FUNZIONE form_scadenze() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                  // form_scadenze($scadenze, $xml_file);
                  ?>
                <!-- </div> -->
                <!-- <div class="tab-pane fade" id="ritenute" role="tabpanel" aria-labelledby="v-pills-messages-tab"> -->
                  <?php  
                  // form_ritenute($ritenute, $xml_file);
                  ?>
                <!-- </div> -->
                <!-- <div class="tab-pane fade" id="beniservizi" role="tabpanel" aria-labelledby="v-pills-settings-tab"> -->
                  <?php  
                  // form_beniservizi($beniservizi, $ddt, $xml_file);
                  ?>
                <!-- </div> -->
                <!-- <div class="tab-pane fade" id="filexml" role="tabpanel" aria-labelledby="v-pills-settings-tab"> -->
                  <?php  
                  // visualizza_dati_xml($xml_file);
                  ?>
                <!-- </div> -->
              <!-- </div> -->
            <!-- </div> -->
            
            <!-- If you want to create a simple horizontal menu, add the .nav class to a <ul> element, followed by .nav-item for each <li> and add the .nav-link class to their links -->

            <!-- To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a <div> element with class .tab-content.

            If you want the tabs to fade in and out when clicking on them, add the .fade class to .tab-pane -->
            <!-- Nav tabs -->
            <!-- <ul class="nav nav-tabs">
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
            </ul> -->

            <!-- Tab panes -->
            <!-- Per fare in modo che i tab appaiano con un’animazione “a comparsa” (fade in), è sufficiente aggiungere la classe .fade ad ogni .tab-pane. Il primo .tab-pane dovrà anche avere la classe .show per rendere il contenuto iniziale visibile. -->
            <!-- <div class="tab-content">
              <div class="tab-pane container fade show active" id="datigen"> -->
                <?php
                //RECUPERO I DATI GENERALI DELLA FATTURA E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $dati_generali CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                //RICHIAMO LA FUNZIONE form_dati_generali() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                // form_dati_generali($dati_generali, $xml_file);
                ?>
              <!-- </div> -->
              <!-- <div class="tab-pane container fade" id="scadenze"> -->
                <?php
                //RECUPERO I DATI SUI PAGAMENTI E LI INSERISCO IN UN FORM PER EVENTUALI MODIFICHE E PER PROCEDERE POI CON LA MEMORIZZAZIONE                
                //I DATI GENERALI SONO CONTENUTI NELL'ARRAY $scadenze CONTENUTO NEL FILE nodi_fe.php CHE E' STATO INCLUSO
                //RICHIAMO LA FUNZIONE form_scadenze() CHE VISUALIZZA E PERMETTE DI MEMORIZZARE I DATI
                // form_scadenze($scadenze, $xml_file);
                ?>
              <!-- </div> -->
              <!-- <div class="tab-pane container fade" id="ritenute"> -->
                <?php  
                // form_ritenute($ritenute, $xml_file);
                ?>
              <!-- </div> -->
              <!-- <div class="tab-pane container fade" id="beniservizi"> -->
                <?php  
                // form_beniservizi($beniservizi, $ddt, $xml_file);
                ?>
              <!-- </div> -->
              <!-- <div class="tab-pane container fade" id="filexml"> -->
                <?php  
                // visualizza_dati_xml($xml_file);
                ?>
              <!-- </div> -->
            <!-- </div> -->

            <?php
      
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
          // }
             
        // }

      ?>
    <!-- </div> -->
  </body>
</html>
        