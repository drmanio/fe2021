<?php
include 'db.php';
$info=array($_POST['info1'],$_POST['info2'],$_POST['info3'],$_POST['info4'],$_POST['info5'],$_POST['info6'],
    $_POST['info7'],$_POST['info8'],$_POST['info9'],$_POST['info10'],$_POST['info11'],$_POST['info12'],
    $_POST['info13'],$_POST['info14'],$_POST['info15'],$_POST['info16']);
$info=str_replace ("'","\'",$info);
switch ($info[4]){
    case '00782150270':
        $azienda=1;
        break;
    case '03742130283':
        $azienda=101;
        break;
    case '03922880277':
        $azienda=102;
        break;
    case '03551610284':
        $azienda=103;
        break;
    case '04513230278':
        $azienda=104;
        break;
}
$istruzione_sql= "INSERT INTO xml_doc_archivio(idFE, File, Protocollo, Barcode, idAzienda, azienda_piva, azienda_cf, 
azienda_den, forn_piva, forn_cf, forn_den, doc_tipo, doc_divisa, doc_data, doc_nr, doc_importo, doc_note) 
VALUES('$info[0]','$info[1]','$info[2]','$info[3]',$azienda,'$info[4]','$info[5]','$info[6]','$info[7]','$info[8]',
'$info[9]','$info[10]','$info[11]','$info[12]','$info[13]',$info[14],'$info[15]')";
$test = mysqli_query($connessioneDB, $istruzione_sql);
if (!$test){
    //SETTAGGIO MESSAGGIO DI ERRORE
    echo ("Messagio di errore: ". mysqli_error($connessioneDB));
} else {
    echo "Dati memorizzati";
}

$uploadDir = __DIR__.'/uploads/'.$azienda;
$uploadDirOld = __DIR__.'/uploads/';
$fileName = $info[1];
rename($uploadDirOld.DIRECTORY_SEPARATOR.$fileName, $uploadDir.DIRECTORY_SEPARATOR.$fileName);
?>

