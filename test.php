<?php
   function func1($data){
      // echo $data+1;
  }

  if (isset($_POST['callFunc1'])) {
      echo func1($_POST['callFunc1']);
  }
?>