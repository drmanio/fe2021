<?php
		include "..\db.php";
        $idazienda=$_GET['idaz'];

		 $filename="quickybook_".date('d-m-Y').".xls";
		 header ("Content-Type: application/vnd.ms-excel");
		 header ("Content-Disposition: inline; filename=$filename");
		 
		 echo "<table>";
				echo "<thead>";
				echo "<th>id</th>";				
				echo "<th>Fornitore</th>";
				echo "<th>IBAN</th>";
				echo "<th>Importo</th>";
				echo "<th>Note</th>";
				echo "<th>Data pagamento</th>";
				echo "</thead>";
				echo "<tbody>";
				
			$query = "SELECT 
			idScadenzario, forn_den, IBAN, importoPagato, Note, DataPagamento 
			FROM pagamenti_temp WHERE idAzienda = '$idazienda'";
			
				$result = mysqli_query($connessioneDB,$query);
				while($row = mysqli_fetch_array($result)){
					//echo print_r($row);
					echo "<tr>";
					echo "<td>".$row['idScadenzario']."</td>";
					echo "<td>".$row['forn_den']."</td>";
					echo "<td>".$row['IBAN']."</td>";					
					echo "<td>".str_replace(".",",",$row['importoPagato'])."</td>";
					echo "<td>".$row['Note']."</td>";
					echo "<td>".$row['DataPagamento']."</td>";
					echo "</tr>";
					}
				echo "</tbody>";
				echo "</table>";

?>