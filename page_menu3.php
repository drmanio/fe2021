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
          sc_menu3();
      });

      function cerca(){
        document.getElementById('row_elenco').className='row show';
        var testo = document.getElementById('testo_da_cercare').value;
        

            $.ajax({
              type: "POST",
              url: "script/carica_dati.php",
              async:false,
              data: {testo:testo},
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

    </script>

  </head>
  <body>

    <?php
      include "navbar.html";
    ?>

<div style="margin-top:80px">
        <h1>Scadenzario</h1>
        <input type='text' id='testo_da_cercare' placeholder='Filtra'></input>
        <button onclick='cerca()' id='btn_cerca'>Carica dati azienda</button>					
</div>

<div class="row" id='row_elenco'>
		<div class='col-md-12' id="elenco">
			<span id="tabella">....</span>
		</div>
	</div>
  
  </body>
</html>