<?php

require_once "../vendor/autoload.php";
require_once "../db.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  
$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
$activeSheet->setTitle('Report_pagamenti');
	 
$activeSheet->setCellValue('A1', 'id');
$activeSheet->setCellValue('B1', 'IdAzienda');
$activeSheet->setCellValue('C1', 'Azienda');
$activeSheet->setCellValue('D1', 'IdFornitore');
$activeSheet->setCellValue('E1', 'Fornitore');
$activeSheet->setCellValue('F1', 'IBAN');
$activeSheet->setCellValue('G1', 'nr_documento');
$activeSheet->setCellValue('H1', 'Importo');
$activeSheet->setCellValue('I1', 'Note');
// $activeSheet->setCellValue('J1', 'Data pagamento');

// include "..\db.php";
$idazienda=$_GET['idaz'];
				
$query = "SELECT pag_tmp.idPagamentiTemp, pag_tmp.idScadenzario, pag_tmp.idAzienda, pag_tmp.denominazione, pag_tmp.forn_piva, pag_tmp.forn_den, 
pag_tmp.IBAN, pag_tmp.doc_nr, pag_tmp.importoPagato, pag_tmp.Note 
FROM fe2021.pagamenti_temp pag_tmp 
INNER JOIN fe2021.bonifici_tmp bon_tmp
ON pag_tmp.idAzienda = '{$idazienda}' AND 
pag_tmp.idPagamentiTemp = bon_tmp.idPagamentiTemp 
ORDER BY pag_tmp.forn_den;";

// "SELECT 
// idScadenzario, idAzienda, denominazione, forn_piva, forn_den, IBAN, doc_nr, importoPagato, Note, DataPagamento 
// FROM pagamenti_temp WHERE idAzienda = '$idazienda' ORDER BY forn_den";
			
$result = mysqli_query($connessioneDB,$query);

if($result->num_rows > 0) {
  $i = 2;
  while($row = $result->fetch_assoc()) {
    if ($row['forn_piva']==""){
      $forn_piva = "ND";
      } else {
        $forn_piva = $row['forn_piva']; 
      }
      $activeSheet->setCellValue('A'.$i, $row['idScadenzario']);
      $activeSheet->setCellValue('B'.$i, $row['idAzienda']);
      $activeSheet->setCellValue('C'.$i, $row['denominazione']);
      $activeSheet->setCellValue('D'.$i, $forn_piva);
      $activeSheet->setCellValue('E'.$i, $row['forn_den']);
      $activeSheet->setCellValue('F'.$i, $row['IBAN']);
      $activeSheet->setCellValue('G'.$i, "Saldo doc. ".$row['doc_nr']);
      $activeSheet->setCellValue('H'.$i, $row['importoPagato']);
      $activeSheet->setCellValue('I'.$i, $row['Note']);
      // $activeSheet->setCellValue('J'.$i, $row['DataPagamento']);
      
      $i++;
  }
}

// apro il file excel
$spreadsheet->setActiveSheetIndex(0);
$filename = 'report_bonifici';

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report.xlsx"');
header('Cache-Control: max-age=0');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$Excel_writer->save('php://output');

exit;

?>