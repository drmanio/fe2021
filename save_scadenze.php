<?php
include 'db.php';
$info=array($_POST['info1'],$_POST['info2'],$_POST['info3'],$_POST['info4'],$_POST['info5'],$_POST['info6'],
    $_POST['info7'],$_POST['info8'],$_POST['info9']);
$info=str_replace ("'","\'",$info);
$istruzione_sql= "INSERT INTO scadenzario(idFE, modPagamento, scadenzaPagamento, importoPagamento, IBAN, Pagato, 
DataPagamento, ModoPagamento, Note) 
VALUES('$info[0]','$info[1]',NULLIF('$info[2]',''),'$info[3]','$info[4]','$info[5]',NULLIF('$info[6]',''),'$info[7]','$info[8]')";
$test = mysqli_query($connessioneDB, $istruzione_sql);
if (!$test){
    //SETTAGGIO MESSAGGIO DI ERRORE
    echo ("Messagio di errore: ". mysqli_error($connessioneDB));
} else {
    echo "Dati memorizzati";
}
?>