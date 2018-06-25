<?php
  include 'includes/header.php';
  include 'includes/connection.php';

  if ( $_SESSION['auth'] ) // проверяем авторизацию / check authorization
  {
    $query = 'SELECT * FROM files WHERE user_id = "'.$_SESSION['id'].'"';
    $files_q = mysqli_query($connection, $query);
    $files = array();

      while( $file = mysqli_fetch_assoc($files_q) )
    {
      $files[] = $file; // обрабатываем данные из БД, создаем массивы / process data from the database, create arrays
    }
    ?>
    <h5 class="col-12 mt-3">Ваши файлы на сервере:</h5>
    <ul class="list-group col-12 file_list">
      <?php
        foreach( $files as $file ) // выводим список файлов / output list of files
        {
          ?>
          <li class="list-group-item">
            <div>File name:
              <h5 class="d-inline-block"><?php echo $file['file_name'] ?></h5>
            </div>
            <p>downloads:
              <span><?php echo $file['downloads'] ?></span>
            </p>
            <p>
              file size:
              <span><?php echo round($file['file_size']/1024, 2) ?>Kb</span>
              // upload date:
              <span><?php echo $file['upload_time'] ?></span>
              //link to file:
              <span><?php echo $_SERVER['HTTP_HOST'] . '/' . $file['short_link'] ?></span>
            </p>
            <p><a href="includes/deleteFile.php?deleteFileId=<?php echo $file['id'] ?>">delete file</a></p> // ссылка на удаление файла / link to delete a file
          </li>
          <?php
        }
      ?>
    </ul>
    <?php
  }
  else
  {
    header('location: index.php');
  }
?>




<?php include 'includes/footer.php' ?>
