<?php
		include "..\db.php";
        $idazienda=$_GET['idaz'];

		 $filename="quickybook_".date('d-m-Y').".xls";
		 header ("Content-Type: application/vnd.ms-excel");
		 header ("Content-Disposition: inline; filename=$filename");
		 
		 echo "<table>";
				echo "<thead>";
				echo "<th>Cognome</th>";				
				echo "<th>Nome</th>";
				echo "<th>Telefono</th>";
				echo "<th>Email</th>";
				echo "</thead>";
				echo "<tbody>";
				
			$query = "SELECT * FROM pagamenti_temp WHERE idAzienda = '$idazienda'";
			
				$result = mysqli_query($connessioneDB,$query);
				while($row = mysqli_fetch_array($result)){
					//echo print_r($row);
					echo "<tr>";
					echo "<td>".$row['forn_den']."</td>";
					echo "<td>".$row['IBAN']."</td>";					
					echo "<td>".str_replace(".",",",$row['importoPagamento'])."</td>";
					echo "<td>".$row['DataPagamento']."</td>";
					echo "</tr>";
					}
				echo "</tbody>";
				echo "</table>";

?>