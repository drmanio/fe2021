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
      // ATTIVO L'EVIDENZIAZIONE DEL PULSANTE
      $("#btn_pagamenti_sc").addClass("active");

      $(document).ready(function(){
        pulsanti();
      });

        $(".cbox_item").select(function(){
          $("#ipt_imp_pag").val("prova");
        });

        function cerca(){
          document.getElementById('row_elenco').className='row show';
          var azienda = document.getElementById('azienda').value;
          var data = document.getElementById('data_pag').value;
        

          $.ajax({
            type: "POST",
            url: "script/carica_dati_pag.php",
            async:false,
            data: {testo:azienda,datapag:data},
            dataType: "html",
            success: function(msg)
            {
              $("#tabella").html(msg);
              
              $(":checkbox").click(function(){
                var importo = $("#ipt_imp_pag").val();
                var nuovo_importo = $(this).val();
                if ($(this).prop('checked') == true) {
                  var totale = Number(importo) + Number(nuovo_importo);
                } else {
                  var totale = Number(importo) - Number(nuovo_importo);
                }
                $("#ipt_imp_pag").val(Number(totale));
              });
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



<div style="margin-left:10px">
        <h1>Visualizza pagamenti</h1>
        <select name="Aziende" id="azienda">
          <option value="" disabled selected>Seleziona azienda</option>
          <option value=1>SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE</option>
          <option value=101>CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL</option>
          <option value=102>FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO</option>
          <option value=103>SERENISSIMA AGRIDATA SRL</option>
          <option value=104>ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL</option>
        </select>
        <label for="">Data pagamento</label>
        <input type="text" id="data_pag" value="" style="text-align: right;">
        <button onclick='cerca()' id='btn_cerca'>Carica dati azienda</button>					
</div>

<div>
  <label for="">Importo bonifico</label>
  <input type="number" id="ipt_imp_pag" style="text-align: right;">
</div>

<div class="row" id='row_elenco'>
		<div class='col-md-12' id="elenco">
			<span id="tabella"></span>
		</div>
	</div>

  </body>
</html>