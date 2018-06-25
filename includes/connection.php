<?php

// проверяем наличие подключения / check for a connection

  require("bd_connect.php");

  $connection = mysqli_connect(DB_SERVER,DB_USER, DB_PASS, DB_NAME);
  if ( $connection == false )
  {
    echo 'could not connect to the database';
    echo mysqli_connect_error();
    exit('no connection to the database');
  }

?>