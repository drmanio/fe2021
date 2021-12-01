<!-- The "upload.php" file contains the code for uploading a file: -->
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
    echo "Sorry, only xml & p7m files are allowed.";
    $uploadOk = 0;
  }
    
  // Check if file already exists

  // First, we will check if the file already exists in the "uploads" folder. If it does, an error message is displayed, and $uploadOk is set to 0:
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size

  // The file input field in our HTML form above is named "fileToUpload".

  // Now, we want to check the size of the file. If the file is larger than 900KB, an error message is displayed, and $uploadOk is set to 0:

  if ($_FILES["fileToUpload"]["size"] > 900000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "<br>";
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

      //LA FUNZIONE strcasecmp PERMETTE DI FARE UNA VERIFICA DELLE STRINGHE CASE INSENSITIVE
      if (strcasecmp($FileType, "p7m") == 0) {
        $file = "..".DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.$target_file;
        $fileout = pathinfo($target_file, PATHINFO_FILENAME);
        $out = shell_exec('cd openssl & openssl smime -decrypt -in '.$file.' -inform DER -verify -noverify -out "..'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$fileout.'"');
        // $out = shell_exec('cd openssl & openssl smime -verify -inform DER -in '.$file.' -noverify -out "..\uploads\\'.$fileout.'"');
        $xml = simplexml_load_file($target_dir.$fileout);
      } else {
          $xml = simplexml_load_file($target_file);
      }
      return $xml;

    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

}


?>