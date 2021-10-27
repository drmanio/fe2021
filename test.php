<html>
  <head>

    <?php
    include "header.html";
    ?>

    <!-- EVIDENZIO IL PULSANTE HOME MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
    <script>
      $(document).ready(function(){
          pulsanti();
          sc_test();
      });
    </script>

  </head>
  <body>

    <?php
      include "navbar.html";
    ?>
    <button type="button" id="btn_prova">Simula Upload</button>       
  
  </body>
</html>