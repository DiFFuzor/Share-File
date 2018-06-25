<?php
  include 'includes/connection.php';

  if ( !empty(($_FILES["user-file"]["tmp_name"])) and is_uploaded_file($_FILES["user-file"]["tmp_name"]) ) //проверяем наличие файла / check the presence of a file
  {
    $blacklist = '/.(com|bat|exe|cmd|vbs|msi|jar|php(\d?)|phtml|access|js)$/i'; //список недопустимых расширений / list of invalid extensions

    if (preg_match($blacklist, $_FILES['user-file']['name'])) //проверяем blacklist / check the blacklist
    {
      echo 'A file with this extension is not allowed to load';
    }
    elseif ( $_FILES['user-file']['size'] >= 1e+7 ) //Блокируем загрузку файлов более 10 мб / Block the upload of files more than 10 mb
    {
      echo 'A file larger than 10 mb is not allowed to load';
    }
    else
    {
      $destination = __DIR__ . '/' . 'uploaded_files/';
      $fileName = $_FILES['user-file']['name'];
      $fileSize = $_FILES['user-file']['size'];
      $fileType = $_FILES['user-file']['type'];
      $fileTmpName = $_FILES['user-file']['tmp_name'];
      $userID = $_SESSION['id'];

      $key = '';
      $keyLength = 4; //длина ключа / key length
      for($i=0; $i<$keyLength; $i++)
      {
        $key .= chr(mt_rand(65,90)) . chr(mt_rand(97,122)); //символ из ASCII-table / character from ASCII-table
      }

      $newFileName = str_replace( '\\', '/', $destination . $key . $fileName );

      $query = 'SELECT * FROM files WHERE file_name="'.$fileName.'"';
      $isFreeFileName = mysqli_fetch_assoc(mysqli_query($connection, $query));

      if ( empty($isFreeFileName) )
      {
        if ( move_uploaded_file($fileTmpName, $newFileName) )  //сохраняем файл / save the file
        {
          echo '<p>file uploaded successfully</p>';

          $query = 'INSERT INTO files SET file_name="'.$fileName.'", upload_time="'.date("Y-m-d H:i:s").'", link_to_file="'.$newFileName.'", user_id="'.$userID.'"';
          mysqli_query($connection, $query);  //вносим данные о файле в БД / enter data about the file in the database

          $query = 'SELECT id FROM files WHERE file_Name="'.$fileName.'"';
          $file = mysqli_fetch_assoc(mysqli_query($connection, $query)); // возвращаем ID файла / return the ID of the file
          $fileID = $file['id'];

          $shortLink = $key.$fileID; //создаем ключ для короткой ссылки / create a key for short link

          echo '<p>unique link to download the file:</p>';
          echo '<h6>' . $_SERVER['HTTP_HOST'] . '/' . $shortLink . '</h6>';

          $query = 'UPDATE files SET short_link="'.$shortLink.'" WHERE id="'.$fileID.'"';
          mysqli_query($connection, $query);  //обновляем короткую ссылку в БД / update the short link in the database
        }
        else
        {
          echo 'error upload file';
        }
      }
      else
      {
        echo 'this file is already uploaded';
      }
    }
  }

?>
