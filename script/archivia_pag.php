<?php
	include "..\db.php";
	$idazienda = $_POST['idAzienda'];
	// $idazienda=$_GET['idaz'];
			
	$query = "INSERT INTO 
	pagamenti_scadenze (idScadenzario, importoPagamento, DataPagamento, ModoPagamento, Note) 
	SELECT idScadenzario, importoPagato, DataPagamento, modPagamento, Note 
	FROM pagamenti_temp WHERE idAzienda = '$idazienda'";

	$result = mysqli_query($connessioneDB,$query);

	$query = "DELETE FROM pagamenti_temp WHERE idAzienda = '$idazienda'";

	$result = mysqli_query($connessioneDB,$query);
		

?>