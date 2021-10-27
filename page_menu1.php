<html>
<head>

<?php
include "header.html";
include "form.php";
include "fe_nodi.php";
include "function.php";
?>

<!-- EVIDENZIO IL PULSANTE HOME MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
<script>
    $(document).ready(function(){
      $("#btn_file_xml").addClass("active");
    });
    </script>

</head>
<body>

<?php
include "navbar.html";
?>

<div id="script_btn"></div>
<div id="xml" class="tab-content container-fluid" style="margin-top:80px">
<!--
FORM INIZIALE PER SELEZIONARE IL FILE E CHIEDERNE LA VISUALIZZAZIONE 
The enctype attribute specifies how the form-data should be encoded when submitting it to the server.
Note: The enctype attribute can be used only if method="post".
Attribute Values:
- application/x-www-form-urlencoded ** Default. All characters are encoded before sent (spaces are converted to "+" symbols, and special characters are converted to ASCII HEX values)
- multipart/form-data ** This value is necessary if the user will upload a file through the form
- text/plain ** Sends data without any encoding at all. Not recommended -->
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
        