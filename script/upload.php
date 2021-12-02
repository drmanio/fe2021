<!-- The "upload.php" file contains the code for uploading a file: -->
<!-- Bootstrap 5 provides an easy way to create predefined alert messages: -->
<!-- Alerts are created with the .alert class, followed by one of the contextual classes .alert-success, .alert-info, .alert-warning, .alert-danger, .alert-primary, .alert-secondary, .alert-light or .alert-dark -->
<!-- To close the alert message, add a .alert-dismissible class to the alert container. Then add class="btn-close" and data-bs-dismiss="alert" to a link or a button element (when you click on this the alert box will disappear). -->
<?php

function carica_xml() {
  // PHP script explained:

  // $target_dir = "uploads/" - specifies the directory where the file is going to be placed
  // Because in different OS there is different directory separator. In Windows it's \ in Linux it's /. DIRECTORY_SEPARATOR is constant with that OS directory separator.
  $target_dir = "uploads".DIRECTORY_SEPARATOR;
  // $target_file specifies the path of the file to be uploaded
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  // $uploadOk=1 is not used yet (will be used later)
  $uploadOk = 1;

  // Now we can add some restrictions.

  // Allow certain file formats
  // $FileType holds the file extension of the file (in lower case)
  $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // The code below only allows users to upload xml and p7m files. All other file types gives an error message before setting $uploadOk to 0:
  if($FileType != "xml" && $FileType != "p7m") {
    echo '<div class="alert alert-secondary alert-dismissible">';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '<strong>Warning!</strong> Sorry, only xml & p7m files are allowed';
    echo '</div>';
    $uploadOk = 0;
  }
    
  // Check if file already exists
  // First, we will check if the file already exists in the uploads folder and subdirectory. If it does, an error message is displayed, and $uploadOk is set to 0:
    
  // Recupero il nome del file, togliendo eventuale p7m
  if (strcasecmp($FileType, "p7m") == 0) {
    $file_verifica = pathinfo($target_file, PATHINFO_FILENAME);
  } else {
    $file_verifica = basename($_FILES["fileToUpload"]["name"]);
  }

  // scandir — List files and directories inside the specified path  
  $cdir = scandir($target_dir);
  //eseguo la verifica se esiste il file all'interno di ogni directory. Se esiste esco dal ciclo e non carico il file
  foreach ($cdir as $elemento){
    //escludo la directory corrente, perchè il file non è ancora stato memorizzato, e quella superiore
    if (!($elemento == '.') && !($elemento == '..')) {
      //verifico se il file esiste. Se esiste esco dal ciclo
      if (file_exists($target_dir.DIRECTORY_SEPARATOR.$elemento.DIRECTORY_SEPARATOR.$file_verifica)) {
        echo '<div class="alert alert-secondary alert-dismissible">';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
        echo '<strong>Warning!</strong> Sorry, file already exists';
        echo '</div>';
        $uploadOk = 0;
        break;
      }
    }
  }

  // Check file size

  // The file input field in our HTML form above is named "fileToUpload".

  // Now, we want to check the size of the file. If the file is larger than 900KB, an error message is displayed, and $uploadOk is set to 0:

  if ($_FILES["fileToUpload"]["size"] > 900000) {
    echo '<div class="alert alert-secondary alert-dismissible">';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '<strong>Warning!</strong> Sorry, your file is too large';
    echo '</div>';
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo '<div class="alert alert-warning alert-dismissible">';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '<strong>Warning!</strong> Sorry, there was an error uploading your file';
    echo '</div>';
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo '<div class="alert alert-success alert-dismissible">';
      echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
      echo '<strong>Success!</strong> The file '.htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). ' has been uploaded';
      echo '</div>';

      //LA FUNZIONE strcasecmp PERMETTE DI FARE UNA VERIFICA DELLE STRINGHE CASE INSENSITIVE
      if (strcasecmp($FileType, "p7m") == 0) {
        $file = "..".DIRECTORY_SEPARATOR.$target_dir.DIRECTORY_SEPARATOR.$target_file;
        $fileout = pathinfo($target_file, PATHINFO_FILENAME);
        $out = shell_exec('cd openssl & openssl smime -decrypt -in '.$file.' -inform DER -verify -noverify -out "..'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$fileout.'"');
        // $out = shell_exec('cd openssl & openssl smime -verify -inform DER -in '.$file.' -noverify -out "..\uploads\\'.$fileout.'"');
        $xml = simplexml_load_file($target_dir.$fileout);
      } else {
          $xml = simplexml_load_file($target_file);
      }
      return $xml;

    } else {
        echo '<div class="alert alert-warning alert-dismissible">';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
        echo '<strong>Warning!</strong> Sorry, there was an error uploading your file';
        echo '</div>';
    }
  }

}


?>