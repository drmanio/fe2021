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
      $("#btn_pagamenti").addClass("active");

      $(document).ready(function(){
          pulsanti();
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
        var data_bon = $('#ipt_date_bon').val();
        alert (data_bon);
        $.ajax({
          type: "POST",
          url: "script/archivia_pag.php",
          async:false,
          data: {idAzienda:iditem,data_arc:data_bon},
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

      function update_bonifico_tmp_all(idazienda) {

        // var bon_importo = document.getElementById('bon_imp'+ id).value;

        if ($('#cbox_all').prop('checked')) {
          var tipo = 'ins_all';
          $( ".cbox_item" ).prop( "checked", true );
        } else {
          var tipo = 'del_all';
          $( ".cbox_item" ).prop( "checked", false );
        }
        $.ajax({
          type: "POST",
          url: "script/update_bonifico_tmp_all.php",
          async:false,
          data: {chiave:tipo,azienda:idazienda},
          dataType:'text',
          success: function(risposta)
          {
            // alert (risposta);
            // $("#ipt_imp_bon").val(risposta);
            risposta = JSON.parse(risposta);

            //  alert(importo);
            $("#ipt_imp_bon").val(risposta.importo);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
          } 
        })
      }

      function update_bonifico_tmp(id, bon_importo) {

        // var bon_importo = document.getElementById('bon_imp'+ id).value;

        if ($('#cbox'+id).prop('checked')) {
          var tipo = 'ins';
        } else {
          var tipo = 'del';
          if ($('#cbox_all').prop('checked')) {
            $( "#cbox_all" ).prop( "checked", false );
          }
        }
        $.ajax({
          type: "POST",
          url: "script/update_bonifico_tmp.php",
          async:false,
          data: {chiave:tipo,idbonifico:id,importo:bon_importo},
          dataType:'text',
          success: function(risposta)
          {
            // alert (risposta);
            // $("#ipt_imp_bon").val(risposta);
            risposta = JSON.parse(risposta);

	          //  alert(importo);
            $("#ipt_imp_bon").val(risposta.importo);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
          } 
        })
      }

      function delete_pag(iditem) {
         
        $.ajax({
          type: "POST",
          url: "script/pay_delete.php",

          async:false,

          data: {idScadenzario:iditem},
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



<div style="margin-left:10px">
        <h1>Esporta/registra pagamenti</h1>
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
		<div class="col-md-12" id="elenco">
			<span id="tabella"></span>
		</div>
	</div>
  
  </body>
</html>