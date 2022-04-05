<?php
	include "..\db.php";
	$idazienda = $_POST['idAzienda'];
  $data_arc = $_POST['data_arc'];
	// $idazienda=$_GET['idaz'];
			
	$query = "INSERT INTO 
	pagamenti_scadenze (idScadenzario, importoPagamento, DataPagamento, ModoPagamento, Note) 
	SELECT 
  pag_tmp.idScadenzario, 
  pag_tmp.importoPagato, 
  '$data_arc', 
  pag_tmp.modPagamento, 
  pag_tmp.Note 
	FROM 
  pagamenti_temp pag_tmp 
  INNER JOIN 
  fe2021.bonifici_tmp bon_tmp
  ON 
  pag_tmp.idAzienda = '$idazienda' AND 
  pag_tmp.idPagamentiTemp = bon_tmp.idPagamentiTemp";

	$result = mysqli_query($connessioneDB,$query);

	$query = "DELETE FROM 
  fe2021.pagamenti_temp 
  WHERE 
  fe2021.pagamenti_temp.idScadenzario = ANY (SELECT idScadenzario FROM fe2021.pagamenti_scadenze);";

	$result = mysqli_query($connessioneDB,$query);
		

?>