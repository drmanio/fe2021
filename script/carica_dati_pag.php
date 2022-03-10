<?php

include "..".DIRECTORY_SEPARATOR."db.php";
$testo = $_POST['testo'];
$data = $_POST['datapag'];
    
switch ($testo){
  case "1":
    $denominazione="SOCIETA' AGRICOLA DE ROSSI SOCIETA' SEMPLICE";
    break;
  case "101":
    $denominazione="CENTRO ASSISTENZA IMPRESE COLDIRETTI VENETO SRL";
    break;
  case "102":
    $denominazione="FEDERAZIONE REGIONALE COLDIRETTI DEL VENETO";
    break;
  case "103":
    $denominazione="SERENISSIMA AGRIDATA SRL";
    break;
  case "104":
    $denominazione="ORGANISMO DI CONSULENZA PSR & INNOVAZIONE VENETO SRL";
    break;
}

$query = "SELECT
xm.idAzienda, 
sc.Id, 
sc.IdFE, 
xm.Protocollo, 
xm.forn_den, 
xm.doc_tipo, 
xm.doc_nr, 
ps.importoPagamento, 
ps.ModoPagamento, 
ps.DataPagamento
FROM 
(fe2021.scadenzario sc
INNER JOIN
fe2021.xml_doc_archivio xm)
INNER JOIN 
fe2021.pagamenti_scadenze ps
WHERE 
idAzienda LIKE ('{$testo}') AND 
ps.DataPagamento LIKE ('%{$data}') AND
sc.IdFE = xm.IdFE AND
ps.idScadenzario = sc.Id
ORDER BY
ps.DataPagamento DESC;";
$dati = mysqli_query($connessioneDB,$query);

?>

<!-- <label for="">Importo bonifico</label>
<input type="text" id="ipt_imp_pag" value="" style="text-align: right;"> -->

<table class="table table-hover table-sm table-striped">
  <thead>
    <tr>
      <th><input type="checkbox" id="cbox_all" onclick="update_bonifico_tmp_all('<?php echo $testo; ?>')"></th>
      <th>Id</th>
      <th>Fornitore</th>
      <th>Protocollo</th>
      <th>Tipo doc</th>
      <th>Nr doc</th>
      <th>Importo pagamento</th>
      <th>Modo pagamento</th>
      <th>Data pagamento</th>
    </tr>
  </thead>
  <tbody>

<?php

if ($dati) {
  while ($row = mysqli_fetch_array($dati)) {
    $Id = $row['Id'];
    $prot = $row['Protocollo'];
    $forn_den = $row['forn_den'];
    $doc_tipo = $row['doc_tipo'];
    $doc_nr = $row['doc_nr'];
    $pag_importo = $row['importoPagamento'];
    $pag_modo = $row['ModoPagamento'];
    $pag_data = $row['DataPagamento'];  
?>

    <tr>
      <th><input type="checkbox" class = "cbox_item" id="cbox<?php echo $Id ?>" value="<?php echo $pag_importo ?>" ></th>
      <th><?php echo $Id ?></th>
      <td><?php echo $prot ?></td>
      <td><?php echo $forn_den ?></td>
      <td><?php echo $doc_tipo ?></td>
      <td><?php echo $doc_nr ?></td>
      <td><?php echo $pag_importo ?></td>
      <td><?php echo $pag_modo ?></td>
      <td><?php echo $pag_data ?></td>  
    </tr>
<?php     
    
  }
}
    
?>
</tbody>
</table>




        
 