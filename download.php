<?php
  include 'includes/header.php';
  include "includes/connection.php";
?>
<div class="account">
  <?php
    if ( !empty($_GET) )
    {
      $fileShort = $_GET['file'];

      $query = 'SELECT * FROM files WHERE short_link="'.$fileShort.'"'; //получаем файл из БД / get the file from the database
      $file =  mysqli_fetch_assoc(mysqli_query($connection, $query));

      if( !empty($file) ) //проверяем наличие файла в БД / check the presence of the file in the database
      {
        echo '<p>File name:</p><h3> ' . $file['file_name'] . '</h3></p>';
        echo '<p>date and time of loading: ' . $file['upload_time'] . '</p>';
        echo '<p>file size: ' . round($file['file_size']/1024, 2) . ' Kb</p>';

        $query = 'UPDATE files SET downloads = downloads + 1 WHERE id = "'.$file['id'].'"';
        mysqli_query($connection,$query);

        $_SESSION['download_file'] = $file['link_to_file'];
        $_SESSION['file_name'] = $file['file_name'];

        echo '<a href="script_download.php"><button class="button_upload text-uppercase">download</button></a>';
      }
      else
      {
        echo '<p>the requested file is not in the database</p>';
      }
    }
    else
    {
      header('location: index.php');
    }
  ?>
</div>

<?php
  include 'includes/footer.php';
?>


