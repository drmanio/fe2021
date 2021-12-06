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

    
  
    

<!-- <div class="sidenav" style="display:none;"> -->
<div class="sidenav">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#datigen" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Dati generali</button>
    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#scadenze" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Scadenze</button>
    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#ritenute" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Ritenute</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#beniservizi" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Beni e servizi</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#filexml" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">File xml</button>
  </div>
</div>

<div class="tab-content" id="v-pills-tabContent" style="margin-left:160px">
  <div class="tab-pane fade show active" id="datigen" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <input type="text" value="Dati generali">
  </div>
  <div class="tab-pane fade" id="scadenze" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <input type="text" value="Scadenze">
  </div>
  <div class="tab-pane fade" id="ritenute" role="tabpanel" aria-labelledby="v-pills-messages-tab">
    <input type="text" value="Ritenute">
  </div>
  <div class="tab-pane fade" id="beniservizi" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <input type="text" value="Beni e servizi">
  </div>
  <div class="tab-pane fade" id="filexml" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <input type="text" value="File xml">
  </div>
</div>


           
  
  </body>
</html>