<html>
  <head>

  <!-- INCLUDO IL COLLEGAMENTO ALL'HEADER E AL DATABASE -->
    <?php
    include "header.html";
    include "db.php";
    ?>

    <!-- EVIDENZIO IL PULSANTE DELLA PAGINA MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
    <script>
      $("#btn_page_menu3").addClass("active");
      // INSERISCO IL RIFERIMENTO ALLA FUNZIONE JS pulsanti() CHE GESTISCE LA PRESSIONE DEI VARI PULSANTI
      $(document).ready(function(){
          pulsanti();
      });

      // FUNZIONE PER CARICARE I DATI RICHIESTI
      function cerca(){
        // MODIFICO LA CLASSE DEL DIV CHE CONTERRA' LA TABELLA PER RENDERLO VISIBILE
        document.getElementById('row_elenco').className='row show';
        // ASSEGNO ALLA VARIABILE AZIENDA IL VALORE DELL'ELEMENTO SELECT CON ID=azienda
        var azienda = document.getElementById('azienda').value;
        
        // CHIAMO UNA FUNZIONE AJAX PER RECUPERARE I DATI DA INSERIRE NELLA TABELLA
        $.ajax({
          // METODO DI TRASMISSIONE DEI DATI
          type: "POST",
          // FILE CHE VIENE RICHIAMATO DALLA FUNZIONE
          url: "script/carica_dati.php",
          // VIENE UTILIZZATO UN METODO SINCRONO
          async:false,
          // VIENE PASSATO, CON IL METODO POST, IL DATO DELLA VARIABILE AZIENDA ASSEGNANDOLO ALLA VARIABILE TESTO
          data: {testo:azienda},
          // TIPO DI DATO PRODOTTO DALLA FUNZIONE
          dataType: "html",
          // IN CASO DI SUCCESSO, IL DATO DI RITORNO DALLA FUNZIONE, VERRA' INSERITO NEL HTML DELL'ELEMENTO SPAN CON ID=tabella
          success: function(msg)
          {
            $("#tabella").html(msg);
          },
          // IN CASO DI INSUCESSO VERRA' EVIDENZIATO IL RELATIVO MESSAGGIO DI ERRORE
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
          } 
        });

      }

      function update_pag(iditem) {
         
			  var importo_mod = document.getElementById('importo_mod'+ iditem).value;
			  var data_mod = document.getElementById('data_mod' + iditem).value;
			  var mezzo_mod = document.getElementById('mezzo_mod' + iditem).value;
			  var note_mod = document.getElementById('note_mod' + iditem).value;
			  
				$.ajax({
				  type: "POST",
				  url: "script/pay_update.php",
				  
				  async:false,
				  
				  data: {idScadenzario:iditem,importoPagamento:importo_mod,DataPagamento:data_mod,ModoPagamento:mezzo_mod,Note:note_mod},
				  dataType: "html",
				  success: function(msg)
				  {
					  id_contact = iditem;
            cerca();
				  },
				  error: function(XMLHttpRequest, textStatus, errorThrown) { 
					  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
				  }  
			  });

      }

      function insert_pag(iditem) {

        $(document).ready(function(){

          var importo_mod = document.getElementById('importoPre_mod'+ iditem).value;
          var iban_mod = document.getElementById('ibanPre_mod' + iditem).value;
          var data_mod = document.getElementById('dataPre_mod' + iditem).value;
          var mezzo_mod = document.getElementById('mezzoPre_mod' + iditem).value;
          var note_mod = document.getElementById('notePre_mod' + iditem).value;
          
          $.ajax({
            type: "POST",
            url: "script/pay_insert.php",

            async:false,

            data: {"idScadenzario":iditem,
              "iban_str":iban_mod,
              "importoPagamento":importo_mod,
              "DataPagamento":data_mod,
              "ModoPagamento":mezzo_mod,
              "Note":note_mod},
            dataType: "html",
            success: function(msg)
            {
              id_contact = iditem;
              cerca();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
              alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }  
          });

        });

        
      }

    </script>

  </head>
  <body>

    <?php
      include "navbar.html";
    ?>

    <div class = "container-fluid">
      <h1>Inserisci pagamenti</h1>
      <!-- INSERISCO UN ELEMENTO SELECT PER SELEZIONARE L'AZIENDA -->
      <select name="Aziende" id="azienda">
        <option value="%">Tutte le aziende</option>
        <option value=1>SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE</option>
        <option value=101>CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL</option>
        <option value=102>FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO</option>
        <option value=103>SERENISSIMA AGRIDATA SRL</option>
        <option value=104>ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL</option>
      </select>
      <!-- PREMENDO IL PULSANTE ATTIVO LA FUNZIONE JS CHE INSERISCE LA TABELLA CON I DATI -->
      <button onclick='cerca()' id='btn_cerca'>Carica dati azienda</button>					
   

      <div class="row hide" id='row_elenco'>
        <div class='col-md-12' id="elenco">
          <span id="tabella"></span>
        </div>
      </div>

    </div>
  
  </body>
</html>