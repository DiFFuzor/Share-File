<?php
  session_start();
  include 'connection.php';

  if ( $_SESSION['auth'] and !empty($_GET) ) //проверяем авторизацию и наличие запроса / we check authorization and availability of the request
  {
    $deleteFileId = $_GET['deleteFileId'];
    $userID = $_SESSION['id'];
    $query = 'SELECT * FROM files WHERE id="'.$deleteFileId.'"';
    $file =  mysqli_fetch_assoc(mysqli_query($connection, $query));

    if ( $file['user_id'] == $userID ) // проверяем соответсвие пользователя файлу / check file for user compliance
    {
      unlink($file['link_to_file']); // удаляем файл из папки /

      $query = 'DELETE FROM files WHERE id="'.$deleteFileId.'"';
      mysqli_query($connection, $query); // удаляем запись из БД / delete the record from the database

      header('location: ../account.php'); // возвращаемся в аккаунт / back to account
    }
  }
  else
  {
    echo 'error';
  }

?>