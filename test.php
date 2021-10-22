<?php
   function func1(){
      echo "PROVA";
      echo "PROVA 2";
  }

  if (isset($_POST['callFunc1'])) {
      func1($_POST['callFunc1']);
  }
?>