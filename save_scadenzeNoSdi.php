<?php
include 'db.php';
include 'function.php';
$id_db=crea_id();

$istruzione_sql = "SELECT * FROM aziende WHERE idAzienda = ".$_POST['info1']."";
$result = mysqli_query($connessioneDB, $istruzione_sql) or die(mysql_error()); // $con è la connessione al database MySQL

while($row = mysqli_fetch_assoc($result)){
    $idAzienda=$row['idAzienda'];
    $codiceFiscale=$row['codiceFiscale'];
    $partitaIva=$row['partitaIva'];
    $denominazione=$row['denominazione'];
}

$info=array($_POST['info2'],$_POST['info3'],$_POST['info4'],$_POST['info5'],$_POST['info6'],
    $_POST['info7'],$_POST['info8'],$_POST['info9'],$_POST['info10'],$_POST['info18'],$_POST['info19']);
$info=str_replace ("'","\'",$info);

$istruzione_sql= "INSERT INTO xml_doc_archivio(idFE, Protocollo, Barcode, idAzienda, azienda_piva, azienda_cf, 
azienda_den, forn_piva, forn_cf, forn_den, doc_tipo, doc_divisa, doc_data, doc_nr, doc_importo, doc_note) 
VALUES('$id_db','$info[9]','$info[10]','$idAzienda','$partitaIva','$codiceFiscale','$denominazione','$info[0]','$info[1]',
'$info[2]','$info[3]','$info[4]',NULLIF('$info[5]',''), '$info[6]','$info[7]','$info[8]')";
$test = mysqli_query($connessioneDB, $istruzione_sql);
if (!$test){
    //SETTAGGIO MESSAGGIO DI ERRORE
    echo ("Messagio di errore: ". mysqli_error($connessioneDB));
} else {
    echo "Dati documento memorizzati";
    echo "<br>";
}

$info_sc=array($_POST['info11'],$_POST['info12'],$_POST['info13'],$_POST['info14'],$_POST['info15'],$_POST['info16'], $_POST['info17']);
$info_sc=str_replace ("'","\'",$info_sc);
$istruzione_sql= "INSERT INTO scadenzario(idFE, scadenzaPagamento, importoPagamento, IBAN, Pagato, 
DataPagamento, ModoPagamento, Note) 
VALUES('$id_db',NULLIF('$info_sc[0]',''),'$info_sc[1]','$info_sc[2]','$info_sc[3]',NULLIF('$info_sc[4]',''),'$info_sc[5]','$info_sc[6]')";
$test = mysqli_query($connessioneDB, $istruzione_sql);
if (!$test){
    //SETTAGGIO MESSAGGIO DI ERRORE
    echo ("Messagio di errore: ". mysqli_error($connessioneDB));
} else {
    echo "Dati scadenze memorizzati";
}

?>
