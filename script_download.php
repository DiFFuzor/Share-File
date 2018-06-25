<?php
  session_start();

  if ( !empty($_SESSION['download_file']) )
  {
    $linkToFile = $_SESSION['download_file'];
    $fileName = $_SESSION['file_name'];

    if ( file_exists($linkToFile) ) //проверяем наличие файла в папке / check the presence of the file in the folder
    {
      $fileDescription = fopen($linkToFile, 'rb'); //чтение файла в бинарном формате / reading a file in binary format

      if ( ob_get_level() > 0 )  //очищаем буфер / clear the buffer
      {
        ob_end_clean();
      }

      header('Content-Type: application/octet-stream');
      header('Content-Description: File Transfer');
      header('Content-Disposition: attachment; filename=' . $fileName);
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . filesize($linkToFile));

      while ( !feof($fileDescription) )
      {
        print  fread( $fileDescription, 8192 );
      }
      fclose( $fileDescription );

      $_SESSION['download_file'] = '';
    }
    else
    {
      echo 'error, no file';
    }
  }

?>