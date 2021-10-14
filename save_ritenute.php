<?php
include 'db.php';
$info=array($_POST['info1'],$_POST['info2'],$_POST['info3'],$_POST['info4'],$_POST['info5'],$_POST['info6'],
    $_POST['info7'],$_POST['info8'],$_POST['info9'],$_POST['info10']);
$info=str_replace ("'","\'",$info);
$istruzione_sql= "INSERT INTO ritenute(idFE, ritenutaTipo, ritenutaImporto, ritenutaAliquota, ritenutaCausale, ritenutaImponibile, ritenutaDataScadenza,
ritenutaPagato, ritenutaDataPagamento, ritenutaNote) 
VALUES('$info[0]','$info[1]','$info[2]','$info[3]','$info[4]','$info[5]',NULLIF('$info[6]',''),'$info[7]',NULLIF('$info[8]',''),'$info[9]')";
$test = mysqli_query($connessioneDB, $istruzione_sql);
if (!$test){
    //SETTAGGIO MESSAGGIO DI ERRORE
    echo ("Messagio di errore: ". mysqli_error($connessioneDB));
} else {
    echo "Dati memorizzati";
}
?>