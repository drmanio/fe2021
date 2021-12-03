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

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#menu1">Menu 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#menu2">Menu 2</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane container active" id="home">...</div>
      <div class="tab-pane container fade" id="menu1">
        <div style="margin-top:80px" id="div_prova">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalModifica">
            Launch demo modal
          </button>

          <!-- Modal -->
          <div class="modal fade" id="modalModifica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane container fade" id="menu2">...</div>
    </div>

           
  
  </body>
</html>