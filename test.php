<html>
  <head>

    <?php
    include "header.html";
    include "navbar.html";
    ?>

    <!-- EVIDENZIO IL PULSANTE HOME MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
    <script>
      $(document).ready(function(){
          pulsanti();
          sc_test();
      });
    </script>

<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

<link rel="stylesheet" href="sidebar.css" type="text/css">

  </head>
  <body>

    
  
    
  <div class="offcanvas offcanvas-start" id="demo">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title">Heading</h1>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas">A Button</button>
  </div>
</div>

<!-- Button to open the offcanvas sidebar -->
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
  Open Offcanvas Sidebar
</button>


           
  
  </body>
</html>