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
    </script>

  </head>
  <body>

    <?php
      include "navbar.html";
    ?>
    
    <div style="margin-top:80px">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Azienda</th>
            <th>Fornitore</th>
            <th>Tipo doc</th>
            <th>Nr doc</th>
            <th>Data doc</th>
            <th>Importo doc</th>
            <th>Scadenza</th>
            <th>Importo scadenza</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = "SELECT Id, denominazione, forn_den, doc_tipo, doc_nr, doc_data, doc_importo, scadenzaPagamento, importoPagamento FROM pagamenti WHERE Pagato = 'NO' ORDER BY scadenzaPagamento";
            $dati = mysqli_query($connessioneDB,$query);

            while ($row = mysqli_fetch_array($dati)) {
              $Id = $row['Id'];
              $denominazione = $row['denominazione'];
              $forn_den = $row['forn_den'];
              $doc_tipo = $row['doc_tipo'];
              $doc_nr = $row['doc_nr'];
              $doc_data = $row['doc_data'];
              $doc_importo = $row['doc_importo'];
              $scadenzaPagamento = $row['scadenzaPagamento'];
              $importoPagamento = $row['importoPagamento'];

              echo "<tr>";
              echo   "<th>{$Id}</th>";
              echo   "<td>{$denominazione}</td>";
              echo   "<td>{$forn_den}</td>";
              echo   "<td>{$doc_tipo}</td>";
              echo   "<td>{$doc_nr}</td>";
              echo   "<td>{$doc_data}</td>";
              echo   "<td>{$doc_importo}</td>";
              echo   "<td>{$scadenzaPagamento}</td>";
              echo   "<td>{$importoPagamento}</td>";
              echo "</tr>";

            }
          ?>
          <!-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr> -->
        </tbody>
      </table>
    </div>
  
  </body>
</html>