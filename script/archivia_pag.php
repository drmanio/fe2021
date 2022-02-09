<?php
	include "..\db.php";
	$idazienda = $_POST['idAzienda'];
	// $idazienda=$_GET['idaz'];
			
	$query = "INSERT INTO 
	pagamenti_scadenze (idScadenzario, importoPagamento, DataPagamento, ModoPagamento, Note) 
	SELECT 
  pag_tmp.idScadenzario, 
  pag_tmp.importoPagato, 
  pag_tmp.DataPagamento, 
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

	$query = "DELETE FROM pagamenti_temp WHERE idAzienda = '$idazienda'";

	$result = mysqli_query($connessioneDB,$query);
		

?>