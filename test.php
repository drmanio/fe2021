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

    <div style="margin-top:80px">
      <button type="button" id="btn_prova">Simula Upload</button>
    </div>
    <?php
      $file = "..\uploads\prova.xml.p7m";
      $out = shell_exec('cd openssl & openssl smime -verify -inform DER -in '.$file.' -noverify -out "..\uploads\prova.xml"');
      var_dump($out);
    ?>       
  
  </body>
</html>