<?php
session_start();
?>

<html>
  <head>

    <?php
    include "header.html";
    include "db.php";
    ?>

    <!-- EVIDENZIO IL PULSANTE HOME MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
    <script>
      $(document).ready(function(){
          pulsanti();
          sc_menu4();
      });

      function cerca(){
        document.getElementById('row_elenco').className='row show';
        var azienda = document.getElementById('azienda').value;
        

        $.ajax({
          type: "POST",
          url: "script/carica_dati_tmp.php",
          async:false,
          data: {testo:azienda},
          dataType: "html",
          success: function(msg)
          {
            $("#tabella").html(msg);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
          } 
        });

      }

      function archivia_pag(iditem) {

        $.ajax({
          type: "POST",
          url: "script/archivia_pag.php",
          async:false,
          data: {idAzienda:iditem},
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

        var importo_mod = document.getElementById('importoPre_mod'+ iditem).value;
        var data_mod = document.getElementById('dataPre_mod' + iditem).value;
        var mezzo_mod = document.getElementById('mezzoPre_mod' + iditem).value;
        var note_mod = document.getElementById('notePre_mod' + iditem).value;
         
        $.ajax({
          type: "POST",
          url: "script/pay_insert.php",

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

    </script>

  </head>
  <body>

    <?php
      include "navbar.html";
      $_SESSION['idaz']="1";
    ?>



<div style="margin-top:80px">
        <h1>Inserisci pagamenti</h1>
        <select name="Aziende" id="azienda">
          <option value="" disabled selected>Seleziona azienda</option>
          <option value=1>SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE</option>
          <option value=101>CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL</option>
          <option value=102>FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO</option>
          <option value=103>SERENISSIMA AGRIDATA SRL</option>
          <option value=104>ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL</option>
        </select>
        <button onclick='cerca()' id='btn_cerca'>Carica dati azienda</button>					
</div>

<div class="row" id='row_elenco'>
		<div class='col-md-12' id="elenco">
			<span id="tabella">....</span>
		</div>
	</div>
  
  </body>
</html>