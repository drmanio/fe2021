<html>
<head>

<?php
include "header.html";
?>

<!-- EVIDENZIO IL PULSANTE HOME MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
<script>
    $(document).ready(function(){
        pulsanti();
        sc_menu2();
    });
</script>

</head>
<body>

<?php
include "navbar.html";
?>

<div id="v-pills-tabContent" class="tab-content container-fluid" style="margin-left:165px">
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
</body>
</html>