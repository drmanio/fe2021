<html>
  <head>

  <!-- INCLUDO IL COLLEGAMENTO ALL'HEADER E AL DATABASE -->
    <?php
    include "header.html";
    include "db.php";
    ?>

    <!-- EVIDENZIO IL PULSANTE DELLA PAGINA MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
    <script>
      
      // INSERISCO IL RIFERIMENTO ALLA FUNZIONE JS pulsanti() CHE GESTISCE LA PRESSIONE DEI VARI PULSANTI
      $(document).ready(function(){
          pulsanti();
      });

      // FUNZIONE PER CARICARE I DATI RICHIESTI
      function cerca(idaz){
        // MODIFICO LA CLASSE DEL DIV CHE CONTERRA' LA TABELLA PER RENDERLO VISIBILE
        // document.getElementById('row_elenco').className='row show';
        // ASSEGNO ALLA VARIABILE AZIENDA IL VALORE DELL'ELEMENTO SELECT CON ID=azienda
        // var azienda = document.getElementById('azienda').value;
        var azienda = idaz;
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

      function update_pag(iditem, idaz) {
         
			  var importo_mod = document.getElementById('importo_mod'+ iditem).value;
			  var data_mod = document.getElementById('data_mod' + iditem).value;
			  var mezzo_mod = document.getElementById('mezzo_mod' + iditem).value;
			  var note_mod = document.getElementById('note_mod' + iditem).value;
			  
				$.ajax({
				  type: "POST",
				  url: "script/pay_update.php",
				  
				  async:false,
				  
				  data: {idScadenzario:iditem,
            importoPagamento:importo_mod,
            DataPagamento:data_mod,
            ModoPagamento:mezzo_mod,
            Note:note_mod},
				  dataType: "html",
				  success: function(msg)
				  {
					  id_contact = iditem;
            cerca(idaz);
				  },
				  error: function(XMLHttpRequest, textStatus, errorThrown) { 
					  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
				  }  
			  });

      }

      function insert_pag(iditem, idaz) {

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
              cerca(idaz);
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
      // riferimento al file che contiene la navbar superiore
     include "navbar.html";
    ?>

    <script>
      $("#btn_page_menu3").addClass("active");
    </script>

    <!-- <div class = "container-fluid"> -->
      <!-- <h1>Inserisci pagamenti</h1> -->
      <!-- INSERISCO UN ELEMENTO SELECT PER SELEZIONARE L'AZIENDA -->
      <!-- <select name="Aziende" id="azienda">
        <option value="%">Tutte le aziende</option>
        <option value=1>SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE</option>
        <option value=101>CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL</option>
        <option value=102>FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO</option>
        <option value=103>SERENISSIMA AGRIDATA SRL</option>
        <option value=104>ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL</option>
      </select> -->
      <!-- PREMENDO IL PULSANTE ATTIVO LA FUNZIONE JS CHE INSERISCE LA TABELLA CON I DATI -->
      <!-- <button onclick='cerca()' id='btn_cerca'>Carica dati azienda</button>					 -->
    <!-- </div> -->

    <div class="offcanvas offcanvas-start" id="select">
      <div class="offcanvas-header">
        <h1 class="offcanvas-title">Seleziona azienda</h1>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <a class="nav-link" href="#" data-bs-toggle="offcanvas" onclick="cerca(1)">SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE</a>
        <a class="nav-link" href="#" data-bs-toggle="offcanvas" onclick="cerca(101)">CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL</a>
        <a class="nav-link" href="#" data-bs-toggle="offcanvas" onclick="cerca(102)">FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO</a>
        <a class="nav-link" href="#" data-bs-toggle="offcanvas" onclick="cerca(103)">SERENISSIMA AGRIDATA SRL</a>
        <a class="nav-link" href="#" data-bs-toggle="offcanvas" onclick="cerca(104)">ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL</a>
        <!-- <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas">A Button</button> -->
      </div>
    </div>

      <!-- <div class="" id='row_elenco'> -->
        <div class='col-md-12' id="elenco">
          <span id="tabella"></span>
        </div>
      <!-- </div> -->

    
  
  </body>
</html>